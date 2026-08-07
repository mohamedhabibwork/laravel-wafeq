<?php

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists purchase orders', function () {
    $this->fakeWafeqPage('/purchase-orders/', [
        ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::purchaseOrders()->list();

    expect($page->results[0])->toBeInstanceOf(PurchaseOrderData::class)
        ->and($page->results[0]->status)->toBe('OPEN');
});

it('creates a purchase order', function () {
    $this->fakeWafeq('/purchase-orders/', ['id' => 'po_new', 'poNumber' => 'PO-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->create([
        'vendor' => 'bn_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($po->id)->toBe('po_new');
});

it('retrieves a purchase order', function () {
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->retrieve('po_1');

    expect($po->id)->toBe('po_1');
});

it('updates a purchase order', function () {
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'BILLED', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->update('po_1', ['status' => 'BILLED']);

    expect($po->status)->toBe('BILLED');
});

it('partial updates a purchase order', function () {
    $this->fakeWafeq('/purchase-orders/po_1/', ['id' => 'po_1', 'poNumber' => 'PO-001', 'status' => 'CLOSED', 'total' => '5000.00', 'currency' => 'SAR']);

    $po = LaravelWafeq::purchaseOrders()->partialUpdate('po_1', ['status' => 'CLOSED']);

    expect($po->status)->toBe('CLOSED');
});

it('destroys a purchase order', function () {
    $this->fakeWafeq('/purchase-orders/po_1/', '', 204);

    expect(LaravelWafeq::purchaseOrders()->destroy('po_1'))->toBeTrue();
});

it('downloads a purchase order', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/purchase-orders/po_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::purchaseOrders()->download('po_1');

    expect($response->body())->toBe('PDF');
});

it('converts a purchase order to a bill', function () {
    $this->fakeWafeq('/purchase-orders/po_1/bill/', ['id' => 'b_new', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::purchaseOrders()->bill('po_1');

    expect($bill)->toBeInstanceOf(BillData::class)
        ->and($bill->id)->toBe('b_new');
});
