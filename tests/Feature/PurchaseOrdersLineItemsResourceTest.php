<?php

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists purchase orders line items', function () {
    $this->fakeWafeqPage('/purchase-orders/line-items/', [
        ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::purchaseOrdersLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(PurchaseOrderLineItemData::class);
});

it('creates a purchase orders line item', function () {
    $this->fakeWafeq('/purchase-orders/line-items/', ['id' => 'poli_new', 'name' => 'Item', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->create([
        'purchase_order' => 'po_1',
        'name' => 'Item',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('poli_new');
});

it('retrieves a purchase orders line item', function () {
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->retrieve('poli_1');

    expect($li->id)->toBe('poli_1');
});

it('updates a purchase orders line item', function () {
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Updated', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->update('poli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a purchase orders line item', function () {
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '20', 'price' => '50.00', 'total' => '1000.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->partialUpdate('poli_1', ['quantity' => '20']);

    expect($li->quantity)->toBe('20');
});

it('destroys a purchase orders line item', function () {
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', '', 204);

    expect(LaravelWafeq::purchaseOrdersLineItems()->destroy('poli_1'))->toBeTrue();
});
