<?php

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceCreated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceDestroyed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceDownloaded;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceListed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoicePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceRetrieved;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists simplified invoices', function () {
    Event::fake([SimplifiedInvoiceListed::class]);
    $this->fakeWafeqPage('/simplified-invoices/', [
        ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OPEN', 'total' => '150.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::simplifiedInvoices()->list();

    expect($page->results[0])->toBeInstanceOf(SimplifiedInvoiceData::class)
        ->and($page->results[0]->status)->toBe('OPEN');

    Event::assertDispatched(SimplifiedInvoiceListed::class);
});

it('creates a simplified invoice', function () {
    Event::fake([SimplifiedInvoiceCreated::class]);
    $this->fakeWafeq('/simplified-invoices/', ['id' => 'si_new', 'invoiceNumber' => 'SI-002', 'status' => 'DRAFT', 'total' => '300.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($si->id)->toBe('si_new');

    Event::assertDispatched(SimplifiedInvoiceCreated::class);
});

it('retrieves a simplified invoice', function () {
    Event::fake([SimplifiedInvoiceRetrieved::class]);
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OPEN', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->retrieve('si_1');

    expect($si->id)->toBe('si_1');

    Event::assertDispatched(SimplifiedInvoiceRetrieved::class);
});

it('updates a simplified invoice', function () {
    Event::fake([SimplifiedInvoiceUpdated::class]);
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'PAID', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->update('si_1', ['status' => 'PAID']);

    expect($si->status)->toBe('PAID');

    Event::assertDispatched(SimplifiedInvoiceUpdated::class);
});

it('partial updates a simplified invoice', function () {
    Event::fake([SimplifiedInvoicePartiallyUpdated::class]);
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OVERDUE', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->partialUpdate('si_1', ['status' => 'OVERDUE']);

    expect($si->status)->toBe('OVERDUE');

    Event::assertDispatched(SimplifiedInvoicePartiallyUpdated::class);
});

it('destroys a simplified invoice', function () {
    Event::fake([SimplifiedInvoiceDestroyed::class]);
    $this->fakeWafeq('/simplified-invoices/si_1/', '', 204);

    expect(LaravelWafeq::simplifiedInvoices()->destroy('si_1'))->toBeTrue();

    Event::assertDispatched(SimplifiedInvoiceDestroyed::class);
});

it('downloads a simplified invoice', function () {
    Event::fake([SimplifiedInvoiceDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/simplified-invoices/si_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::simplifiedInvoices()->download('si_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(SimplifiedInvoiceDownloaded::class);
});

it('generates a tax authority report', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/simplified-invoices/si_1/tax_authority_report/*' => Http::response('{"status":"queued"}', 200, ['Content-Type' => 'application/json']),
    ]);

    $response = LaravelWafeq::simplifiedInvoices()->taxAuthorityReport('si_1', ['type' => 'vat']);

    expect($response->body())->toContain('queued');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/simplified-invoices/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::simplifiedInvoices()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(SimplifiedInvoiceData::class)
        ->and($result->id)->toBe('m_1');
});
