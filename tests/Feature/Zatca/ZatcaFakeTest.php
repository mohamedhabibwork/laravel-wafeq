<?php

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDeviceStatus;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentStatus;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDownloadType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaWalletBalance;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\ZatcaSubmissionException;
use HWafeq\LaravelWafeq\Exceptions\ZatcaValidationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Testing\ZatcaFake;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\AssertionFailedError;

beforeEach(function () {
    config()->set('wafeq.http.retry.delay', 0);
});

/**
 * @return array<string, mixed>
 */
function zatcaFakeDocument(string $number = 'INV-1'): array
{
    return [
        'document_number' => $number,
        'supply_date' => '2026-11-06',
        'line_items' => [
            ['item' => 'A', 'description' => 'A', 'quantity' => 2, 'unit_price' => 100, 'tax' => ['type' => 'S', 'percent' => 15]],
            ['item' => 'B', 'description' => 'B', 'quantity' => 1, 'unit_price' => 50, 'tax' => ['type' => 'Z', 'percent' => 0]],
        ],
    ];
}

it('fakes a successful report that echoes the request', function () {
    ZatcaFake::fake();

    $document = LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaFakeDocument(), ['reference' => 'order-42', 'metadata' => ['k' => 'v']]);

    expect($document->isReported())->toBeTrue()
        ->and($document->document?->documentNumber)->toBe('INV-1')
        ->and($document->id())->toStartWith('zdoc_')
        ->and($document->reference)->toBe('order-42')
        ->and($document->metadata)->toBe(['k' => 'v'])
        ->and($document->qrCodeData)->not->toBeEmpty();

    ZatcaFake::assertReported(ZatcaDocumentType::SimplifiedInvoice, fn (array $body) => $body['reference'] === 'order-42');
    ZatcaFake::assertNotReported(ZatcaDocumentType::Invoice);
    ZatcaFake::assertSentToEnvironment(ZatcaEnvironment::Simulation);
});

it('gives each document number a stable id', function () {
    ZatcaFake::fake();
    $invoices = LaravelWafeq::zatca()->invoices();

    expect($invoices->report(zatcaFakeDocument('A'))->id())->toBe($invoices->report(zatcaFakeDocument('A'))->id())
        ->and($invoices->report(zatcaFakeDocument('A'))->id())->not->toBe($invoices->report(zatcaFakeDocument('B'))->id());
});

it('fakes issuing and bulk endpoints', function () {
    ZatcaFake::fake();
    $resource = LaravelWafeq::zatca()->simplifiedCreditNotes();

    expect($resource->issue(zatcaFakeDocument())->statusEnum())->toBe(ZatcaDocumentStatus::Queued)
        ->and($resource->bulkIssue([['document' => zatcaFakeDocument('A')], ['document' => zatcaFakeDocument('B')]]))->toHaveCount(2)
        ->and($resource->bulkReport([['document' => zatcaFakeDocument('C')]])[0]->document?->documentNumber)->toBe('C');

    ZatcaFake::assertIssued(ZatcaDocumentType::SimplifiedCreditNote);
});

it('computes validation totals from the line items', function () {
    ZatcaFake::fake();

    $result = LaravelWafeq::zatca()->invoices()->validate(zatcaFakeDocument());

    expect($result->calculatedTotalAmountNet)->toBe(250.0)
        ->and($result->calculatedTotalAmountTax)->toBe(30.0)
        ->and($result->calculatedTotalAmountGross)->toBe(280.0);

    ZatcaFake::assertNothingReported();
});

it('fakes reads, metadata, retry, send and downloads', function () {
    ZatcaFake::fake();
    $invoices = LaravelWafeq::zatca()->invoices();

    expect($invoices->list()->count)->toBe(0)
        ->and($invoices->retrieve('zdoc_9')->id())->toBe('zdoc_9')
        ->and($invoices->updateMetadata('zdoc_9', ['a' => '1', 'b' => null])->metadata)->toBe(['a' => '1'])
        ->and($invoices->retry('zdoc_9')->isReported())->toBeTrue()
        ->and($invoices->send('zdoc_9', ['channels' => []])->sentTs)->not->toBeNull()
        ->and($invoices->download('zdoc_9')->header('Content-Type'))->toBe('application/pdf')
        ->and($invoices->download('zdoc_9', ZatcaDownloadType::Xml)->body())->toContain('<Invoice/>');
});

it('fakes the platform flow and scopes devices to the request headers', function () {
    ZatcaFake::fake();
    $zatca = LaravelWafeq::zatca()->production();

    $account = $zatca->connectedAccounts()->create(['name' => 'ABCD', 'tax_registration_number' => '311111111111113']);
    $device = $zatca->forConnectedAccount($account->id)->forBranch('Jeddah')->devices()->register('POS 1', '123456');

    expect($account->id)->toStartWith('ca_')
        ->and($account->name)->toBe('ABCD')
        ->and($device->status)->toBe(ZatcaDeviceStatus::Active)
        ->and($device->commonName)->toBe('POS 1')
        ->and($device->connectedAccount)->toBe($account->id)
        ->and($device->branch)->toBe('Jeddah')
        ->and($zatca->devices()->revoke($device->id)->status)->toBe(ZatcaDeviceStatus::Revoked)
        ->and($zatca->connectedAccounts()->destroy($account->id))->toBeTrue()
        ->and($zatca->usage()->retrieve()->balance)->toBe(ZatcaWalletBalance::Ok);

    ZatcaFake::assertDeviceRegistered(fn (array $body) => $body['otp'] === '123456');
    ZatcaFake::assertSentForConnectedAccount($account->id);
    ZatcaFake::assertSentToEnvironment(ZatcaEnvironment::Production);
});

it('overrides endpoints with error responses', function () {
    ZatcaFake::fake([
        'simplified-invoices/report/' => ZatcaFake::validationError('Invalid VAT number.', 'document.supplier'),
        'invoices/report/' => ZatcaFake::submissionError('Clearance rejected.'),
        'POST debit-notes/*' => ZatcaFake::noActiveDevice(),
    ]);
    $zatca = LaravelWafeq::zatca();

    expect(fn () => $zatca->simplifiedInvoices()->report(zatcaFakeDocument()))
        ->toThrow(ZatcaValidationException::class, 'Invalid VAT number. (document.supplier)')
        ->and(fn () => $zatca->invoices()->report(zatcaFakeDocument()))
        ->toThrow(ZatcaSubmissionException::class, 'Clearance rejected.')
        ->and(fn () => $zatca->debitNotes()->report(zatcaFakeDocument()))
        ->toThrow(AuthenticationException::class, 'No active device found.')
        ->and($zatca->debitNotes()->retrieve('zdoc_1')->id())->toBe('zdoc_1');
});

it('accepts arrays and callables as overrides', function () {
    ZatcaFake::fake([
        'usage/' => ZatcaFake::usage(['available' => 0, 'balance' => 'OUT', 'enforced' => true]),
        'GET devices/*' => fn (Request $request) => ZatcaFake::page([ZatcaFake::device('pending', ['id' => 'zdev_9'])]),
    ]);

    expect(LaravelWafeq::zatca()->usage()->retrieve()->isBlocked())->toBeTrue()
        ->and(LaravelWafeq::zatca()->devices()->list()->results[0]->status)->toBe(ZatcaDeviceStatus::Pending);
});

it('leaves non-ZATCA requests to other fakes', function () {
    ZatcaFake::fake();
    Http::fake(['https://api-sandbox.wafeq.com/v1/*' => Http::response(['id' => 'c_1', 'name' => 'Contact'])]);

    expect(LaravelWafeq::contacts()->retrieve('c_1')->id)->toBe('c_1')
        ->and(ZatcaFake::recorded())->toHaveCount(0);
});

it('fails assertions with a clear message', function () {
    ZatcaFake::fake();

    expect(fn () => ZatcaFake::assertReported(ZatcaDocumentType::Invoice))
        ->toThrow(AssertionFailedError::class, 'No [invoices] document was reported to ZATCA.')
        ->and(fn () => ZatcaFake::assertDeviceRegistered())
        ->toThrow(AssertionFailedError::class, 'No ZATCA device was registered.');
});

it('respects a custom ZATCA base URL', function () {
    config()->set('wafeq.zatca.base_url', 'https://gateway.test/v1');
    ZatcaFake::fake();

    expect(LaravelWafeq::zatca()->usage()->retrieve()->available)->toBe(1000)
        ->and(ZatcaFake::recorded())->toHaveCount(1);
});
