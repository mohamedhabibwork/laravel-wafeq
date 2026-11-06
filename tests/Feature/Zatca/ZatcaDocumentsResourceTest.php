<?php

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentSummaryData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaValidationResultData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentStatus;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDownloadType;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDocumentIssued;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDocumentReported;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Exceptions\ZatcaSubmissionException;
use HWafeq\LaravelWafeq\Exceptions\ZatcaValidationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

/**
 * @return array<string, mixed>
 */
function zatcaDocumentPayload(): array
{
    return [
        'currency' => 'SAR',
        'document_number' => 'INV-0001',
        'supplier' => [
            'name' => 'ABCD Inc',
            'identification' => ['type' => 'CRN', 'value' => '1234567890'],
        ],
        'line_items' => [
            ['description' => 'Item', 'quantity' => '1', 'unit_price' => '100', 'tax' => ['type' => 'S', 'percent' => '15']],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function zatcaDetailResponse(string $status = 'REPORTED'): array
{
    return [
        'created_ts' => '2026-11-06T10:00:00Z',
        'document' => ['id' => 'zdoc_1', 'document_number' => 'INV-0001', 'issue_datetime' => '2026-11-06T10:00:00Z', 'supply_date' => '2026-11-06'],
        'metadata' => ['order' => '42'],
        'qr_code_data' => 'AQ1BQkNEIEluYw==',
        'reference' => 'order-42',
        'reported_ts' => $status === 'REPORTED' ? '2026-11-06T10:00:01Z' : null,
        'response' => ['validationResults' => ['status' => 'PASS']],
        'sent_ts' => null,
        'status' => $status,
    ];
}

beforeEach(function () {
    config()->set('wafeq.http.retry.delay', 0);
});

it('reports a B2C simplified invoice to the simulation environment', function () {
    Event::fake([ZatcaDocumentReported::class]);
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response(zatcaDetailResponse(), 201)]);

    $document = LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaDocumentPayload(), ['reference' => 'order-42']);

    expect($document)->toBeInstanceOf(ZatcaDocumentData::class)
        ->and($document->id())->toBe('zdoc_1')
        ->and($document->document?->documentNumber)->toBe('INV-0001')
        ->and($document->isReported())->toBeTrue()
        ->and($document->statusEnum())->toBe(ZatcaDocumentStatus::Reported)
        ->and($document->qrCodeData)->toBe('AQ1BQkNEIEluYw==')
        ->and($document->metadata)->toBe(['order' => '42']);

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->hasHeader('X-ZATCA-Environment', 'simulation')
        && $request['reference'] === 'order-42'
        && $request['document']['document_number'] === 'INV-0001');

    Event::assertDispatched(ZatcaDocumentReported::class, fn (ZatcaDocumentReported $event) => $event->id === 'zdoc_1');
});

it('reports and delivers a document through channels in one request', function () {
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response(zatcaDetailResponse(), 201)]);
    $channels = [['medium' => 'email', 'data' => ['recipients' => ['to' => ['customer@example.com']], 'subject' => 'Your invoice', 'message' => 'Thanks']]];

    LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaDocumentPayload(), ['channels' => $channels, 'language' => 'ar']);

    Http::assertSent(fn (Request $request) => $request['channels'] === $channels && $request['language'] === 'ar');
});

it('keeps the document argument authoritative over a document option', function () {
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response(zatcaDetailResponse(), 201)]);

    LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaDocumentPayload(), ['document' => ['currency' => 'USD']]);

    Http::assertSent(fn (Request $request) => $request['document']['currency'] === 'SAR');
});

it('reports a B2C refund as a simplified credit note', function () {
    Http::fake([ZATCA_URL.'/simplified-credit-notes/report/' => Http::response(zatcaDetailResponse(), 201)]);

    expect(LaravelWafeq::zatca()->simplifiedCreditNotes()->report(zatcaDocumentPayload())->id())->toBe('zdoc_1');
});

it('issues a simplified invoice asynchronously', function () {
    Event::fake([ZatcaDocumentIssued::class]);
    Http::fake([ZATCA_URL.'/simplified-invoices/issue/' => Http::response(zatcaDetailResponse('QUEUED'), 202)]);

    $document = LaravelWafeq::zatca()->simplifiedInvoices()->issue(zatcaDocumentPayload());

    expect($document->statusEnum())->toBe(ZatcaDocumentStatus::Queued)
        ->and($document->statusEnum()?->isInProgress())->toBeTrue()
        ->and($document->isReported())->toBeFalse();

    Event::assertDispatched(ZatcaDocumentIssued::class);
});

it('bulk issues simplified debit notes', function () {
    Http::fake([ZATCA_URL.'/simplified-debit-notes/bulk-issue/' => Http::response([zatcaDetailResponse('QUEUED'), zatcaDetailResponse('QUEUED')], 202)]);

    $documents = LaravelWafeq::zatca()->simplifiedDebitNotes()->bulkIssue([
        ['document' => zatcaDocumentPayload()],
        ['document' => zatcaDocumentPayload()],
    ]);

    expect($documents)->toHaveCount(2)
        ->and($documents[0])->toBeInstanceOf(ZatcaDocumentData::class);

    Http::assertSent(fn (Request $request) => array_is_list($request->data()) && count($request->data()) === 2);
});

it('clears a B2B invoice and a B2B credit note', function () {
    Http::fake([
        ZATCA_URL.'/invoices/report/' => Http::response(zatcaDetailResponse(), 201),
        ZATCA_URL.'/credit-notes/report/' => Http::response(zatcaDetailResponse(), 201),
    ]);

    $zatca = LaravelWafeq::zatca()->production();

    expect($zatca->invoices()->report(zatcaDocumentPayload())->isReported())->toBeTrue()
        ->and($zatca->creditNotes()->report(zatcaDocumentPayload())->isReported())->toBeTrue();

    Http::assertSentCount(2);
    Http::assertSent(fn (Request $request) => $request->hasHeader('X-ZATCA-Environment', 'production'));
});

it('validates a document without reporting it', function () {
    Http::fake([ZATCA_URL.'/debit-notes/validate/' => Http::response([
        'document_number' => 'DN-1',
        'currency' => 'SAR',
        'calculated_total_amount_gross' => 115.0,
        'calculated_total_amount_tax' => 15,
        'provided_tax_total' => '15',
    ])]);

    $result = LaravelWafeq::zatca()->debitNotes()->validate(zatcaDocumentPayload());

    expect($result)->toBeInstanceOf(ZatcaValidationResultData::class)
        ->and($result->calculatedTotalAmountGross)->toBe(115.0)
        ->and($result->calculatedTotalAmountTax)->toBe(15.0);
});

it('bulk reports and bulk validates documents', function () {
    Http::fake([
        ZATCA_URL.'/prepayment-invoices/bulk-report/' => Http::response([['status' => 'QUEUED', 'created_ts' => 'now', 'document' => ['id' => 'zdoc_1', 'document_number' => 'P-1']]], 202),
        ZATCA_URL.'/prepayment-invoices/bulk-validate/' => Http::response([['document_number' => 'P-1', 'currency' => 'SAR']]),
    ]);

    $resource = LaravelWafeq::zatca()->prepaymentInvoices();
    $queued = $resource->bulkReport([['document' => zatcaDocumentPayload()]]);
    $validated = $resource->bulkValidate([['document' => zatcaDocumentPayload()]]);

    expect($queued[0])->toBeInstanceOf(ZatcaDocumentSummaryData::class)
        ->and($queued[0]->id())->toBe('zdoc_1')
        ->and($validated[0]->documentNumber)->toBe('P-1');
});

it('lists, retrieves, retries, sends and updates metadata', function () {
    Http::fake([
        ZATCA_URL.'/invoices/?status=ERROR' => Http::response(['count' => 1, 'next' => null, 'previous' => null, 'results' => [['status' => 'ERROR', 'created_ts' => 'now', 'document' => ['id' => 'zdoc_1', 'document_number' => 'INV-1']]]]),
        ZATCA_URL.'/invoices/zdoc_1/retry/' => Http::response(zatcaDetailResponse()),
        ZATCA_URL.'/invoices/zdoc_1/send/' => Http::response(zatcaDetailResponse()),
        ZATCA_URL.'/invoices/zdoc_1/' => Http::response(zatcaDetailResponse()),
    ]);

    $invoices = LaravelWafeq::zatca()->invoices();
    $page = $invoices->list(['status' => 'ERROR']);

    expect($page->count)->toBe(1)
        ->and($page->results[0]->statusEnum())->toBe(ZatcaDocumentStatus::Error)
        ->and($invoices->retrieve('zdoc_1')->reference)->toBe('order-42')
        ->and($invoices->retry('zdoc_1')->isReported())->toBeTrue()
        ->and($invoices->send('zdoc_1', ['channels' => []])->id())->toBe('zdoc_1')
        ->and($invoices->updateMetadata('zdoc_1', ['order' => null])->id())->toBe('zdoc_1');

    Http::assertSent(fn (Request $request) => $request->method() === 'PATCH' && $request->data() === ['metadata' => ['order' => null]]);
    Http::assertSent(fn (Request $request) => str_ends_with($request->url(), '/retry/') && $request->method() === 'POST');
});

it('downloads the signed XML and regenerates a PDF', function () {
    Http::fake([
        ZATCA_URL.'/simplified-invoices/zdoc_1/download/?type=xml' => Http::response('<Invoice/>', 200, ['Content-Type' => 'application/xml']),
        ZATCA_URL.'/simplified-invoices/zdoc_1/download/?type=pdf&regenerate=true' => Http::response('%PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $resource = LaravelWafeq::zatca()->simplifiedInvoices();

    expect($resource->download('zdoc_1', ZatcaDownloadType::Xml)->body())->toBe('<Invoice/>')
        ->and($resource->download('zdoc_1', regenerate: true)->body())->toBe('%PDF');
});

it('raises a ZATCA validation error for a rejected payload and does not retry it', function () {
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response([
        'type' => 'validation_error',
        'errors' => [['code' => 'invalid', 'detail' => 'Supplier VAT number is invalid.', 'attr' => 'document.supplier.tax_registration_number']],
        'metadata' => null,
    ], 400)]);

    try {
        LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaDocumentPayload());
        $this->fail('Expected a ZatcaValidationException.');
    } catch (ZatcaValidationException $exception) {
        expect($exception)->toBeInstanceOf(ValidationException::class)
            ->and($exception->getMessage())->toBe('Supplier VAT number is invalid. (document.supplier.tax_registration_number)')
            ->and($exception->statusCode)->toBe(400)
            ->and($exception->zatcaErrors()[0]['code'])->toBe('invalid');
    }

    Http::assertSentCount(1);
});

it('raises a submission error when ZATCA rejects reporting', function () {
    Http::fake([ZATCA_URL.'/invoices/report/' => Http::response([
        'type' => 'client_error',
        'errors' => [['code' => 'zatca_error', 'detail' => 'ZATCA clearance failed.', 'attr' => null]],
        'metadata' => null,
    ], 424)]);

    LaravelWafeq::zatca()->invoices()->report(zatcaDocumentPayload());
})->throws(ZatcaSubmissionException::class, 'ZATCA clearance failed.');

it('raises an authentication error when no active device exists', function () {
    Http::fake([ZATCA_URL.'/simplified-invoices/report/' => Http::response(['attr' => null, 'code' => 'permission_denied', 'detail' => 'No active device found.'], 403)]);

    LaravelWafeq::zatca()->simplifiedInvoices()->report(zatcaDocumentPayload());
})->throws(AuthenticationException::class, 'No active device found.');

it('retries a rate-limited request', function () {
    Http::fake([ZATCA_URL.'/usage/' => Http::sequence()->push(['detail' => 'slow down'], 429)->push(['available' => 3])]);

    expect(LaravelWafeq::zatca()->usage()->retrieve()->available)->toBe(3);

    Http::assertSentCount(2);
});
