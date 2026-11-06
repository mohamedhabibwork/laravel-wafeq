<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaExemptionReason;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaLanguage;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxCategory;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaCreditNoteRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaDebitNoteRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaInvoiceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaPrepaymentInvoiceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaPrepaymentSimplifiedInvoiceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaSimplifiedCreditNoteRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaSimplifiedDebitNoteRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ReportZatcaSimplifiedInvoiceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\ZatcaDocumentFormRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

/**
 * A minimal valid simplified (B2C) invoice body in wire format.
 *
 * @return array<string, mixed>
 */
function zatcaWireRequest(array $documentOverrides = [], array $options = []): array
{
    return [
        ...$options,
        'document' => array_replace([
            'document_number' => 'INV-0001',
            'currency' => 'SAR',
            'supply_date' => '2026-11-06',
            'supplier' => [
                'name' => 'ABCD Inc',
                'address' => ['street' => 'Anas Bin Malik', 'building' => '3141', 'city' => 'Riyadh', 'district' => 'Al Malqa', 'postal_code' => '13521', 'country' => 'SA'],
                'identification' => ['type' => 'CRN', 'value' => '1234567890'],
            ],
            'customer' => [],
            'line_items' => [
                ['item' => 'iPhone', 'description' => 'iPhone 15 Pro', 'quantity' => 1, 'unit_price' => 4699, 'tax' => ['type' => 'S', 'percent' => 15]],
            ],
        ], $documentOverrides),
    ];
}

/**
 * @return array<string, mixed>
 */
function zatcaB2bCustomer(): array
{
    return [
        'name' => 'Buyer LLC',
        'tax_registration_number' => '311111111111113',
        'address' => ['street' => 'King Fahd Road', 'city' => 'Riyadh', 'country' => 'SA'],
    ];
}

/**
 * @return array<string, mixed>
 */
function zatcaNoteFields(): array
{
    return [
        'reference_document_number' => 'INV-0001',
        'payment_means' => ['code' => '10', 'issue_reason' => 'Returned goods'],
    ];
}

/**
 * @param  class-string<ZatcaDocumentFormRequest>  $class
 * @param  array<string, mixed>  $payload
 * @return array<string, array<int, string>>
 */
function zatcaRequestErrors(string $class, array $payload): array
{
    return Validator::make($payload, (new $class)->rules())->errors()->toArray();
}

it('maps every document FormRequest to its document type', function (string $class, ZatcaDocumentType $type) {
    $request = new $class;

    expect($request)->toBeInstanceOf(WafeqFormRequest::class)
        ->and($request->documentType())->toBe($type)
        ->and($request->dto())->toBe(ZatcaReportRequestData::class)
        ->and($request->authorize())->toBeTrue();
})->with([
    [ReportZatcaInvoiceRequest::class, ZatcaDocumentType::Invoice],
    [ReportZatcaCreditNoteRequest::class, ZatcaDocumentType::CreditNote],
    [ReportZatcaDebitNoteRequest::class, ZatcaDocumentType::DebitNote],
    [ReportZatcaPrepaymentInvoiceRequest::class, ZatcaDocumentType::PrepaymentInvoice],
    [ReportZatcaSimplifiedInvoiceRequest::class, ZatcaDocumentType::SimplifiedInvoice],
    [ReportZatcaSimplifiedCreditNoteRequest::class, ZatcaDocumentType::SimplifiedCreditNote],
    [ReportZatcaSimplifiedDebitNoteRequest::class, ZatcaDocumentType::SimplifiedDebitNote],
    [ReportZatcaPrepaymentSimplifiedInvoiceRequest::class, ZatcaDocumentType::PrepaymentSimplifiedInvoice],
]);

it('accepts a minimal B2C invoice with an empty customer', function () {
    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, zatcaWireRequest()))->toBe([]);
});

it('requires the core document fields', function () {
    $errors = zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, ['document' => ['customer' => []]]);

    expect($errors)->toHaveKeys([
        'document.document_number',
        'document.currency',
        'document.supply_date',
        'document.supplier',
        'document.line_items',
    ]);
});

it('requires a named customer with an address on B2B documents', function () {
    $errors = zatcaRequestErrors(ReportZatcaInvoiceRequest::class, zatcaWireRequest());

    expect($errors)->toHaveKeys(['document.customer.name', 'document.customer.address'])
        ->and(zatcaRequestErrors(ReportZatcaInvoiceRequest::class, zatcaWireRequest(['customer' => zatcaB2bCustomer()])))->toBe([]);
});

it('requires the original invoice and an issue reason on notes', function (string $class) {
    $customer = (new $class)->documentType()->isSimplified() ? [] : zatcaB2bCustomer();

    $errors = zatcaRequestErrors($class, zatcaWireRequest(['customer' => $customer]));

    expect($errors)->toHaveKeys(['document.reference_document_number', 'document.payment_means', 'document.payment_means.code', 'document.payment_means.issue_reason'])
        ->and(zatcaRequestErrors($class, zatcaWireRequest(['customer' => $customer, ...zatcaNoteFields()])))->toBe([]);
})->with([
    ReportZatcaCreditNoteRequest::class,
    ReportZatcaDebitNoteRequest::class,
    ReportZatcaSimplifiedCreditNoteRequest::class,
    ReportZatcaSimplifiedDebitNoteRequest::class,
]);

it('prohibits note-only fields on invoices', function () {
    $errors = zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, zatcaWireRequest(zatcaNoteFields()));

    expect($errors)->toHaveKeys(['document.reference_document_number', 'document.payment_means.issue_reason']);
});

it('prohibits deducting prepayments on a prepayment invoice', function () {
    $prepayments = ['prepayments' => [['reference' => 'P-1', 'issue_datetime' => '2026-11-01T10:00:00Z', 'amount' => 100, 'tax' => ['type' => 'S', 'percent' => 15]]]];

    expect(zatcaRequestErrors(ReportZatcaPrepaymentSimplifiedInvoiceRequest::class, zatcaWireRequest($prepayments)))->toHaveKey('document.prepayments')
        ->and(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, zatcaWireRequest($prepayments)))->toBe([]);
});

it('requires an exemption reason for non-standard tax', function () {
    $zeroRated = zatcaWireRequest(['line_items' => [
        ['item' => 'Export', 'description' => 'Export', 'quantity' => 1, 'unit_price' => 10, 'tax' => ['type' => 'Z', 'percent' => 0]],
    ]]);

    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, $zeroRated))->toHaveKey('document.line_items.0.tax.exemption_reason');

    $zeroRated['document']['line_items'][0]['tax']['exemption_reason'] = 'VATEX-SA-32';

    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, $zeroRated))->toBe([]);
});

it('requires free text for the out-of-scope exemption', function () {
    $payload = zatcaWireRequest(['line_items' => [
        ['item' => 'Fee', 'description' => 'Fee', 'quantity' => 1, 'unit_price' => 10, 'tax' => ['type' => 'O', 'percent' => 0, 'exemption_reason' => 'VATEX-SA-OOS']],
    ]]);

    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, $payload))->toHaveKey('document.line_items.0.tax.exemption_reason_text');
});

it('validates codes, enums and formats', function () {
    $payload = zatcaWireRequest([
        'currency' => 'XXX',
        'supply_date' => '06/11/2026',
        'indicators' => ['EXPORT', 'UNKNOWN'],
        'charges' => [['reason' => 'NOPE', 'amount' => 5, 'tax' => ['type' => 'S', 'percent' => 15]]],
        'discounts' => [['reason' => '95', 'percent' => 10, 'tax' => ['type' => 'S', 'percent' => 150]]],
        'customer' => ['tax_registration_number' => '123'],
    ]);
    $payload['document']['supplier']['identification']['type'] = 'PAS';
    $payload['document']['supplier']['address']['country'] = 'ZZ';

    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, $payload))->toHaveKeys([
        'document.currency',
        'document.supply_date',
        'document.indicators.1',
        'document.charges.0.reason',
        'document.discounts.0.base_amount',
        'document.discounts.0.tax.percent',
        'document.customer.tax_registration_number',
        'document.supplier.identification.type',
        'document.supplier.address.country',
    ]);
});

it('validates delivery channels', function () {
    $payload = zatcaWireRequest(options: [
        'language' => 'fr',
        'channels' => [['medium' => 'sms', 'data' => ['recipients' => ['to' => ['not-an-email']], 'subject' => 'S', 'message' => 'M']]],
    ]);

    expect(zatcaRequestErrors(ReportZatcaSimplifiedInvoiceRequest::class, $payload))->toHaveKeys([
        'language',
        'channels.0.medium',
        'channels.0.data.recipients.to.0',
    ]);
});

it('materialises a typed report request from the validated payload', function () {
    $payload = zatcaWireRequest(
        ['line_items' => [
            ['item' => 'Export', 'description' => 'Export', 'quantity' => 2, 'unit_price' => 50, 'tax' => ['type' => 'Z', 'percent' => 0, 'exemption_reason' => 'VATEX-SA-33']],
        ]],
        ['language' => 'ar', 'reference' => 'order-42', 'channels' => [['medium' => 'email', 'data' => ['recipients' => ['to' => ['c@example.com']], 'subject' => 'S', 'message' => 'M']]]],
    );

    $request = ReportZatcaSimplifiedInvoiceRequest::create('/zatca/simplified-invoices/report/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));
    $request->validateResolved();

    $dto = $request->toDto();

    expect($dto)->toBeInstanceOf(ZatcaReportRequestData::class)
        ->and($dto->language)->toBe(ZatcaLanguage::Arabic)
        ->and($dto->reference)->toBe('order-42')
        ->and($dto->document->currency)->toBe(Currency::SAR)
        ->and($dto->document->lineItems[0]->tax->type)->toBe(ZatcaTaxCategory::ZeroRated)
        ->and($dto->document->lineItems[0]->tax->exemptionReason)->toBe(ZatcaExemptionReason::ExportOfServices)
        ->and($dto->channels[0]->data['recipients']['to'])->toBe(['c@example.com'])
        ->and($dto->toPayload()['document']['line_items'][0]['quantity'])->toBe(2.0);
});
