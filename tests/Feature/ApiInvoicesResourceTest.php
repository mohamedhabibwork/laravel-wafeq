<?php

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Exceptions\RateLimitException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists api invoices', function () {
    $this->fakeWafeqPage('/api-invoices/', [
        ['id' => 'inv_1', 'reference' => 'INV-001', 'invoiceNumber' => 'INV-2024-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR'],
        ['id' => 'inv_2', 'reference' => 'INV-002', 'invoiceNumber' => 'INV-2024-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::apiInvoices()->list();

    expect($page)->toBeInstanceOf(PaginatedData::class)
        ->and($page->results)->toHaveCount(2)
        ->and($page->results[0])->toBeInstanceOf(ApiInvoiceData::class)
        ->and($page->results[0]->reference)->toBe('INV-001');
});

it('retrieves an api invoice', function () {
    $this->fakeWafeq('/api-invoices/inv_1/', ['id' => 'inv_1', 'reference' => 'INV-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR']);

    $invoice = LaravelWafeq::apiInvoices()->retrieve('inv_1');

    expect($invoice->id)->toBe('inv_1')
        ->and($invoice->status)->toBe('SENT');
});

it('destroys an api invoice', function () {
    $this->fakeWafeq('/api-invoices/inv_1/', '', 204);

    expect(LaravelWafeq::apiInvoices()->destroy('inv_1'))->toBeTrue();
});

it('downloads an api invoice (binary response)', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/api-invoices/inv_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::apiInvoices()->download('inv_1');

    expect($response->body())->toBe('PDF_BINARY')
        ->and($response->header('Content-Type'))->toBe('application/pdf');
});

it('returns the summary of an api invoice', function () {
    $this->fakeWafeq('/api-invoices/inv_1/summary/', [
        'subtotal' => '1000.00',
        'tax' => '150.00',
        'total' => '1150.00',
        'currency' => 'SAR',
    ]);

    $summary = LaravelWafeq::apiInvoices()->summary('inv_1');

    expect($summary)->toBe([
        'subtotal' => '1000.00',
        'tax' => '150.00',
        'total' => '1150.00',
        'currency' => 'SAR',
    ]);
});

it('bulk sends api invoices', function () {
    $this->fakeWafeq('/api-invoices/bulk_send/', ['queued' => 2], 200);

    $result = LaravelWafeq::apiInvoices()->bulkSend([
        ['reference' => 'INV-001', 'invoice_number' => 'INV-2024-001'],
        ['reference' => 'INV-002', 'invoice_number' => 'INV-2024-002'],
    ]);

    expect($result)->toBe(['queued' => 2]);
});

it('throws RateLimitException on bulkSend when rate-limited', function () {
    $this->fakeRateLimit('/api-invoices/bulk_send/');

    LaravelWafeq::apiInvoices()->bulkSend([['reference' => 'INV-001']]);
})->throws(RateLimitException::class);
