<?php

use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaClientContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaSimplifiedDocumentsResourceContract;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;
use HWafeq\LaravelWafeq\Exceptions\ZatcaConfigurationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaDocumentsResource;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaSimplifiedDocumentsResource;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('exposes the ZATCA client from the facade', function () {
    expect(LaravelWafeq::zatca())->toBeInstanceOf(ZatcaClientContract::class);
});

it('defaults to the simulation environment', function () {
    expect(LaravelWafeq::zatca()->environment())->toBe(ZatcaEnvironment::Simulation)
        ->and(LaravelWafeq::zatca()->headers())->toBe(['X-ZATCA-Environment' => 'simulation']);
});

it('reads environment, branch and connected account from config', function () {
    config()->set('wafeq.zatca.environment', 'production');
    config()->set('wafeq.zatca.branch', '3125678939');
    config()->set('wafeq.zatca.connected_account', 'ca_1');

    $zatca = LaravelWafeq::zatca();

    expect($zatca->headers())->toBe([
        'X-ZATCA-Environment' => 'production',
        'X-ZATCA-Branch' => '3125678939',
        'X-ZATCA-Connected-Account-Id' => 'ca_1',
    ]);
});

it('returns re-scoped copies without mutating the original', function () {
    $base = LaravelWafeq::zatca();
    $scoped = $base->production()->forBranch('Jeddah')->forConnectedAccount('ca_9');

    expect($base->environment())->toBe(ZatcaEnvironment::Simulation)
        ->and($base->branch())->toBeNull()
        ->and($base->connectedAccount())->toBeNull()
        ->and($scoped->environment())->toBe(ZatcaEnvironment::Production)
        ->and($scoped->branch())->toBe('Jeddah')
        ->and($scoped->connectedAccount())->toBe('ca_9');
});

it('clears a configured scope when passed null', function () {
    config()->set('wafeq.zatca.connected_account', 'ca_1');

    $zatca = LaravelWafeq::zatca()->forConnectedAccount(null)->simulation();

    expect($zatca->connectedAccount())->toBeNull()
        ->and($zatca->headers())->not->toHaveKey('X-ZATCA-Connected-Account-Id');
});

it('accepts the environment as a string', function () {
    expect(LaravelWafeq::zatca()->withEnvironment('Production')->environment())->toBe(ZatcaEnvironment::Production);
});

it('rejects an unknown environment', function () {
    LaravelWafeq::zatca()->withEnvironment('sandbox');
})->throws(ZatcaConfigurationException::class, 'Unknown ZATCA environment [sandbox]');

it('infers the environment from a dedicated ZATCA key', function () {
    config()->set('wafeq.zatca.environment', null);
    config()->set('wafeq.zatca.api_key', 'zatca_live_abc');

    expect(LaravelWafeq::zatca()->environment())->toBe(ZatcaEnvironment::Production);
});

it('refuses a ZATCA key that names a different environment', function () {
    config()->set('wafeq.zatca.api_key', 'zatca_live_abc');

    LaravelWafeq::zatca()->simulation();
})->throws(ZatcaConfigurationException::class, 'scoped to [production]');

it('sends the dedicated ZATCA key, versioned Accept header and scope headers', function () {
    config()->set('wafeq.zatca.api_key', 'zatca_sim_xyz');
    Http::fake([ZATCA_URL.'/devices/*' => Http::response(['count' => 0, 'next' => null, 'previous' => null, 'results' => []])]);

    LaravelWafeq::zatca()->forBranch('Riyadh')->devices()->list();

    Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Api-Key zatca_sim_xyz')
        && $request->hasHeader('Accept', 'application/json; version=v1')
        && $request->hasHeader('X-ZATCA-Environment', 'simulation')
        && $request->hasHeader('X-ZATCA-Branch', 'Riyadh'));
});

it('targets the production host even when the accounting API uses sandbox', function () {
    Http::fake([ZATCA_URL.'/usage/' => Http::response(['available' => 10])]);

    LaravelWafeq::zatca()->usage()->retrieve();

    Http::assertSent(fn (Request $request) => str_starts_with($request->url(), ZATCA_URL.'/usage/'));
});

it('honours a base URL override', function () {
    config()->set('wafeq.zatca.base_url', 'https://gateway.test/v1');
    Http::fake(['https://gateway.test/v1/zatca/usage/' => Http::response(['available' => 1])]);

    expect(LaravelWafeq::zatca()->usage()->retrieve()->available)->toBe(1);
});

it('sends connected-account and usage requests without scope headers', function () {
    config()->set('wafeq.zatca.connected_account', 'ca_1');
    Http::fake([ZATCA_URL.'/*' => Http::response(['count' => 0, 'next' => null, 'previous' => null, 'results' => []])]);

    LaravelWafeq::zatca()->connectedAccounts()->list();
    LaravelWafeq::zatca()->usage()->retrieve();

    Http::assertSentCount(2);
    Http::assertNotSent(fn (Request $request) => $request->hasHeader('X-ZATCA-Connected-Account-Id')
        || $request->hasHeader('X-ZATCA-Environment'));
});

it('builds the right resource for every document type', function (ZatcaDocumentType $type) {
    $resource = LaravelWafeq::zatca()->documents($type);

    expect($resource->type())->toBe($type)
        ->and($resource instanceof ZatcaSimplifiedDocumentsResourceContract)->toBe($type->isSimplified());
})->with(ZatcaDocumentType::cases());

it('refuses to build a simplified resource for a standard document', function () {
    new ZatcaSimplifiedDocumentsResource(Http::baseUrl(ZATCA_URL), ZatcaDocumentType::Invoice);
})->throws(ZatcaConfigurationException::class);

it('exposes a named accessor per document family', function () {
    $zatca = LaravelWafeq::zatca();

    expect($zatca->invoices()->type())->toBe(ZatcaDocumentType::Invoice)
        ->and($zatca->creditNotes()->type())->toBe(ZatcaDocumentType::CreditNote)
        ->and($zatca->debitNotes()->type())->toBe(ZatcaDocumentType::DebitNote)
        ->and($zatca->prepaymentInvoices()->type())->toBe(ZatcaDocumentType::PrepaymentInvoice)
        ->and($zatca->invoices())->toBeInstanceOf(ZatcaDocumentsResource::class)
        ->and($zatca->simplifiedInvoices()->type())->toBe(ZatcaDocumentType::SimplifiedInvoice)
        ->and($zatca->simplifiedCreditNotes()->type())->toBe(ZatcaDocumentType::SimplifiedCreditNote)
        ->and($zatca->simplifiedDebitNotes()->type())->toBe(ZatcaDocumentType::SimplifiedDebitNote)
        ->and($zatca->prepaymentSimplifiedInvoices()->type())->toBe(ZatcaDocumentType::PrepaymentSimplifiedInvoice);
});
