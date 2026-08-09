<?php

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemCreated;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemListed;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists purchase orders line items', function () {
    Event::fake([PurchaseOrderLineItemListed::class]);
    $this->fakeWafeqPage('/purchase-orders/line-items/', [
        ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::purchaseOrdersLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(PurchaseOrderLineItemData::class);

    Event::assertDispatched(PurchaseOrderLineItemListed::class);
});

it('creates a purchase orders line item', function () {
    Event::fake([PurchaseOrderLineItemCreated::class]);
    $this->fakeWafeq('/purchase-orders/line-items/', ['id' => 'poli_new', 'name' => 'Item', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->create([
        'purchase_order' => 'po_1',
        'name' => 'Item',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('poli_new');

    Event::assertDispatched(PurchaseOrderLineItemCreated::class);
});

it('retrieves a purchase orders line item', function () {
    Event::fake([PurchaseOrderLineItemRetrieved::class]);
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->retrieve('poli_1');

    expect($li->id)->toBe('poli_1');

    Event::assertDispatched(PurchaseOrderLineItemRetrieved::class);
});

it('updates a purchase orders line item', function () {
    Event::fake([PurchaseOrderLineItemUpdated::class]);
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Updated', 'quantity' => '10', 'price' => '50.00', 'total' => '500.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->update('poli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(PurchaseOrderLineItemUpdated::class);
});

it('partial updates a purchase orders line item', function () {
    Event::fake([PurchaseOrderLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', ['id' => 'poli_1', 'name' => 'Item', 'quantity' => '20', 'price' => '50.00', 'total' => '1000.00']);

    $li = LaravelWafeq::purchaseOrdersLineItems()->partialUpdate('poli_1', ['quantity' => '20']);

    expect($li->quantity)->toBe('20');

    Event::assertDispatched(PurchaseOrderLineItemPartiallyUpdated::class);
});

it('destroys a purchase orders line item', function () {
    Event::fake([PurchaseOrderLineItemDestroyed::class]);
    $this->fakeWafeq('/purchase-orders/line-items/poli_1/', '', 204);

    expect(LaravelWafeq::purchaseOrdersLineItems()->destroy('poli_1'))->toBeTrue();

    Event::assertDispatched(PurchaseOrderLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/purchase-orders/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::purchaseOrdersLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PurchaseOrderLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
