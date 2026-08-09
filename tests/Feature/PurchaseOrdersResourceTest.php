<?php

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderCreated;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderDestroyed;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderDownloaded;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderListed;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderRetrieved;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists purchase orders', function () {
    Event::fake([PurchaseOrderListed::class]);
    $this->fakeWafeqPage('/purchase-orders/', [
        ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::purchaseOrders()->list();

    expect($page->results[0])->toBeInstanceOf(PurchaseOrderData::class)
        ->and($page->results[0]->status)->toBe('OPEN');

    Event::assertDispatched(PurchaseOrderListed::class);
});

it('creates a purchase order', function () {
    Event::fake([PurchaseOrderCreated::class]);
    $this->fakeWafeq('/purchase-orders/', ['id' => 'po_new', 'poNumber' => 'PO-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->create([
        'vendor' => 'bn_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($po->id)->toBe('po_new');

    Event::assertDispatched(PurchaseOrderCreated::class);
});

it('retrieves a purchase order', function () {
    Event::fake([PurchaseOrderRetrieved::class]);
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->retrieve('po_1');

    expect($po->id)->toBe('po_1');

    Event::assertDispatched(PurchaseOrderRetrieved::class);
});

it('updates a purchase order', function () {
    Event::fake([PurchaseOrderUpdated::class]);
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'BILLED', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->update('po_1', ['status' => 'BILLED']);

    expect($po->status)->toBe('BILLED');

    Event::assertDispatched(PurchaseOrderUpdated::class);
});

it('partial updates a purchase order', function () {
    Event::fake([PurchaseOrderPartiallyUpdated::class]);
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'CLOSED', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->partialUpdate('po_1', ['status' => 'CLOSED']);

    expect($po->status)->toBe('CLOSED');

    Event::assertDispatched(PurchaseOrderPartiallyUpdated::class);
});

it('destroys a purchase order', function () {
    Event::fake([PurchaseOrderDestroyed::class]);
    $this->fakeWafeq('/purchase-orders/po_1/', '', 204);

    expect(LaravelWafeq::purchaseOrders()->destroy('po_1'))->toBeTrue();

    Event::assertDispatched(PurchaseOrderDestroyed::class);
});

it('downloads a purchase order', function () {
    Event::fake([PurchaseOrderDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/purchase-orders/po_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::purchaseOrders()->download('po_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(PurchaseOrderDownloaded::class);
});

it('converts a purchase order to a bill', function () {
    $this->fakeWafeq('/purchase-orders/po_1/bill/', ['id' => 'b_new', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::purchaseOrders()->bill('po_1');

    expect($bill)->toBeInstanceOf(BillData::class)
        ->and($bill->id)->toBe('b_new');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/purchase-orders/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::purchaseOrders()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PurchaseOrderData::class)
        ->and($result->id)->toBe('m_1');
});
