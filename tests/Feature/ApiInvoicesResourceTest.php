<?php

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceDestroyed;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceDownloaded;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceListed;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceRetrieved;
use HWafeq\LaravelWafeq\Exceptions\RateLimitException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists api invoices', function () {
    Event::fake([ApiInvoiceListed::class]);
    $this->fakeWafeqPage('/api-invoices/', [
        ['id' => 'inv_1', 'reference' => 'INV-001', 'invoiceNumber' => 'INV-2024-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR'],
        ['id' => 'inv_2', 'reference' => 'INV-002', 'invoiceNumber' => 'INV-2024-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::apiInvoices()->list();

    expect($page)->toBeInstanceOf(PaginatedData::class)
        ->and($page->results)->toHaveCount(2)
        ->and($page->results[0])->toBeInstanceOf(ApiInvoiceData::class)
        ->and($page->results[0]->reference)->toBe('INV-001');

    Event::assertDispatched(ApiInvoiceListed::class);
});

it('retrieves an api invoice', function () {
    Event::fake([ApiInvoiceRetrieved::class]);
    $this->fakeWafeq('/api-invoices/inv_1/', ['id' => 'inv_1', 'reference' => 'INV-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR']);

    $invoice = LaravelWafeq::apiInvoices()->retrieve('inv_1');

    expect($invoice->id)->toBe('inv_1')
        ->and($invoice->status)->toBe('SENT');

    Event::assertDispatched(ApiInvoiceRetrieved::class);
});

it('destroys an api invoice', function () {
    Event::fake([ApiInvoiceDestroyed::class]);
    $this->fakeWafeq('/api-invoices/inv_1/', '', 204);

    expect(LaravelWafeq::apiInvoices()->destroy('inv_1'))->toBeTrue();

    Event::assertDispatched(ApiInvoiceDestroyed::class);
});

it('downloads an api invoice (binary response)', function () {
    Event::fake([ApiInvoiceDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/api-invoices/inv_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::apiInvoices()->download('inv_1');

    expect($response->body())->toBe('PDF_BINARY')
        ->and($response->header('Content-Type'))->toBe('application/pdf');

    Event::assertDispatched(ApiInvoiceDownloaded::class);
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

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/api-invoices/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::apiInvoices()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ApiInvoiceData::class)
        ->and($result->id)->toBe('m_1');
});
