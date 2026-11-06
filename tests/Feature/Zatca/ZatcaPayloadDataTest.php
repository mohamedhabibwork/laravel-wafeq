<?php

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaAddressData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaChannelData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaConnectedAccountPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaCustomerData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDiscountData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDocumentPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaLineItemData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaPartyIdentificationData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaPaymentMeansData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaSupplierData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaTaxData;
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaCustomerIdentificationType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentIndicator;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaExemptionReason;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaLanguage;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxAmountType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxCategory;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

function zatcaBuiltDocument(): ZatcaDocumentPayloadData
{
    return new ZatcaDocumentPayloadData(
        documentNumber: 'INV-0001',
        currency: Currency::SAR,
        supplyDate: '2026-11-06',
        supplier: new ZatcaSupplierData(
            name: 'ABCD Inc',
            address: new ZatcaAddressData(street: 'Anas Bin Malik', building: '3141', city: 'Riyadh', district: 'Al Malqa', postalCode: '13521'),
            identification: ZatcaPartyIdentificationData::commercialRegistration('1234567890'),
        ),
        customer: new ZatcaCustomerData(
            name: 'John Doe',
            identification: ZatcaPartyIdentificationData::customer(ZatcaCustomerIdentificationType::NationalId, '1010101010'),
        ),
        lineItems: [
            ZatcaLineItemData::make('iPhone 15 Pro', quantity: 1, unitPrice: 4699),
            ZatcaLineItemData::make('Export service', quantity: 2, unitPrice: 50, tax: ZatcaTaxData::zeroRated(ZatcaExemptionReason::ExportOfServices)),
        ],
        taxTotal: 704.85,
        taxAmountType: ZatcaTaxAmountType::Exclusive,
        discounts: [new ZatcaDiscountData(reason: '95', tax: ZatcaTaxData::standard(), amount: 10)],
        indicators: [ZatcaDocumentIndicator::Export],
    );
}

it('serialises a built document to the snake_case wire format without nulls', function () {
    $payload = zatcaBuiltDocument()->toPayload();

    expect($payload)->toMatchArray([
        'document_number' => 'INV-0001',
        'currency' => 'SAR',
        'supply_date' => '2026-11-06',
        'tax_total' => 704.85,
        'tax_amount_type' => 'E',
        'indicators' => ['EXPORT'],
    ])
        ->and($payload['supplier'])->toBe([
            'name' => 'ABCD Inc',
            'address' => ['country' => 'SA', 'street' => 'Anas Bin Malik', 'building' => '3141', 'city' => 'Riyadh', 'district' => 'Al Malqa', 'postal_code' => '13521'],
            'identification' => ['type' => 'CRN', 'value' => '1234567890'],
        ])
        ->and($payload['customer'])->toBe(['name' => 'John Doe', 'identification' => ['type' => 'NAT', 'value' => '1010101010']])
        ->and($payload['line_items'][0])->toBe([
            'item' => 'iPhone 15 Pro',
            'description' => 'iPhone 15 Pro',
            'quantity' => 1.0,
            'unit_price' => 4699.0,
            'tax' => ['type' => 'S', 'percent' => 15.0],
            'charges' => [],
            'discounts' => [],
        ])
        ->and($payload['line_items'][1]['tax'])->toBe(['type' => 'Z', 'percent' => 0.0, 'exemption_reason' => 'VATEX-SA-33'])
        ->and($payload['discounts'][0])->toBe(['reason' => '95', 'tax' => ['type' => 'S', 'percent' => 15.0], 'amount' => 10.0])
        ->and($payload)->not->toHaveKeys(['supply_end_date', 'payment_means', 'reference_document_number', 'note']);
});

it('hydrates a document from the wire format', function () {
    $document = ZatcaDocumentPayloadData::from(zatcaBuiltDocument()->toPayload());

    expect($document->currency)->toBe(Currency::SAR)
        ->and($document->lineItems[1])->toBeInstanceOf(ZatcaLineItemData::class)
        ->and($document->lineItems[1]->tax->type)->toBe(ZatcaTaxCategory::ZeroRated)
        ->and($document->lineItems[1]->tax->exemptionReason)->toBe(ZatcaExemptionReason::ExportOfServices)
        ->and($document->supplier->address->postalCode)->toBe('13521')
        ->and($document->toPayload())->toBe(zatcaBuiltDocument()->toPayload());
});

it('sends an anonymous B2C customer as a JSON object', function () {
    $document = new ZatcaDocumentPayloadData(
        documentNumber: 'INV-2',
        currency: Currency::SAR,
        supplyDate: '2026-11-06',
        supplier: zatcaBuiltDocument()->supplier,
        lineItems: [ZatcaLineItemData::make('Coffee', quantity: 1, unitPrice: 10)],
    );

    expect(json_encode($document->toPayload()))->toContain('"customer":{}')
        ->and(json_encode(ZatcaReportRequestData::for($document)->toPayload()))->toContain('"customer":{}');
});

it('builds tax helpers for every category', function () {
    expect(ZatcaTaxData::standard()->toPayload())->toBe(['type' => 'S', 'percent' => 15.0])
        ->and(ZatcaTaxData::exempt(ZatcaExemptionReason::FinancialServices)->type)->toBe(ZatcaTaxCategory::Exempt)
        ->and(ZatcaTaxData::outOfScope('Not taxable')->toPayload())->toBe([
            'type' => 'O', 'percent' => 0.0, 'exemption_reason' => 'VATEX-SA-OOS', 'exemption_reason_text' => 'Not taxable',
        ]);
});

it('maps exemption reasons to their tax category', function () {
    expect(ZatcaExemptionReason::RealEstate->category())->toBe(ZatcaTaxCategory::Exempt)
        ->and(ZatcaExemptionReason::OutOfScope->category())->toBe(ZatcaTaxCategory::OutOfScope)
        ->and(ZatcaExemptionReason::PrivateHealthcare->category())->toBe(ZatcaTaxCategory::ZeroRated)
        ->and(ZatcaExemptionReason::forCategory(ZatcaTaxCategory::Exempt))->toHaveCount(3)
        ->and(ZatcaTaxCategory::Standard->requiresExemptionReason())->toBeFalse();
});

it('builds an email channel and flattens a report request', function () {
    $request = ZatcaReportRequestData::for(zatcaBuiltDocument(), new ZatcaDeliveryOptionsData(
        channels: [ZatcaChannelData::email('customer@example.com', 'Your invoice', 'Thanks', cc: ['ops@example.com'])],
        language: ZatcaLanguage::Arabic,
        reference: 'order-42',
    ));

    $payload = $request->toPayload();

    expect(array_keys($payload))->toBe(['document', 'channels', 'language', 'reference'])
        ->and($payload['channels'][0])->toBe([
            'medium' => 'email',
            'data' => [
                'recipients' => ['to' => ['customer@example.com'], 'cc' => ['ops@example.com']],
                'subject' => 'Your invoice',
                'message' => 'Thanks',
            ],
        ])
        ->and($payload['language'])->toBe('ar')
        ->and($payload['document']['document_number'])->toBe('INV-0001');
});

it('reports a typed document through the resource', function () {
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response(['status' => 'REPORTED', 'document' => ['id' => 'zdoc_1', 'document_number' => 'INV-0001']], 201)]);

    LaravelWafeq::zatca()->simplifiedInvoices()->report(
        zatcaBuiltDocument(),
        new ZatcaDeliveryOptionsData(channels: [ZatcaChannelData::email('a@example.com', 'S', 'M')]),
    );

    Http::assertSent(fn (Request $request) => $request['document']['currency'] === 'SAR'
        && $request['document']['line_items'][0]['unit_price'] == 4699
        && $request['channels'][0]['medium'] === 'email');
});

it('lets explicit options override those carried by a report request', function () {
    Http::fake([ZATCA_URL.'/invoices/validate/' => Http::response(['document_number' => 'INV-0001'])]);

    $request = ZatcaReportRequestData::for(zatcaBuiltDocument(), new ZatcaDeliveryOptionsData(reference: 'from-dto', language: ZatcaLanguage::English));

    LaravelWafeq::zatca()->invoices()->validate($request, ['reference' => 'explicit']);

    Http::assertSent(fn (Request $request) => $request['reference'] === 'explicit'
        && $request['language'] === 'en'
        && $request['document']['document_number'] === 'INV-0001');
});

it('bulk reports a mix of typed requests and arrays', function () {
    Http::fake([ZATCA_URL.'/credit-notes/bulk-report/' => Http::response([], 202)]);

    $note = zatcaBuiltDocument();
    $note->referenceDocumentNumber = 'INV-0001';
    $note->paymentMeans = new ZatcaPaymentMeansData(code: '10', issueReason: 'Returned goods');

    LaravelWafeq::zatca()->creditNotes()->bulkReport([
        ZatcaReportRequestData::for($note),
        ['document' => ['document_number' => 'CN-2']],
    ]);

    Http::assertSent(fn (Request $request) => $request->data()[0]['document']['payment_means'] === ['code' => '10', 'issue_reason' => 'Returned goods']
        && $request->data()[0]['document']['reference_document_number'] === 'INV-0001'
        && $request->data()[1] === ['document' => ['document_number' => 'CN-2']]);
});

it('creates a connected account from a typed payload', function () {
    Http::fake([ZATCA_URL.'/connected-accounts/' => Http::response(['id' => 'ca_1', 'name' => 'ABCD Inc'], 201)]);

    LaravelWafeq::zatca()->connectedAccounts()->create(new ZatcaConnectedAccountPayloadData(
        name: 'ABCD Inc',
        address: 'Anas Bin Malik',
        city: 'Riyadh',
        country: 'SA',
        businessCategory: 'Manufacturing',
        taxRegistrationNumber: '311111111111113',
    ));

    Http::assertSent(fn (Request $request) => $request['business_category'] === 'Manufacturing'
        && $request['tax_registration_number'] === '311111111111113');
});
