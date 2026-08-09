<?php

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemCreated;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemListed;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists invoices line items', function () {
    Event::fake([InvoiceLineItemListed::class]);
    $this->fakeWafeqPage('/invoices/line-items/', [
        ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00', 'account' => 'acc_1', 'taxRate' => 'tx_1'],
    ]);

    $page = LaravelWafeq::invoicesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(InvoiceLineItemData::class)
        ->and($page->results[0]->taxRate)->toBe('tx_1');

    Event::assertDispatched(InvoiceLineItemListed::class);
});

it('creates an invoices line item', function () {
    Event::fake([InvoiceLineItemCreated::class]);
    $this->fakeWafeq('/invoices/line-items/', ['id' => 'ili_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::invoicesLineItems()->create([
        'invoice' => 'inv_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('ili_new');

    Event::assertDispatched(InvoiceLineItemCreated::class);
});

it('retrieves an invoices line item', function () {
    Event::fake([InvoiceLineItemRetrieved::class]);
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::invoicesLineItems()->retrieve('ili_1');

    expect($li->id)->toBe('ili_1');

    Event::assertDispatched(InvoiceLineItemRetrieved::class);
});

it('updates an invoices line item', function () {
    Event::fake([InvoiceLineItemUpdated::class]);
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Updated', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::invoicesLineItems()->update('ili_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(InvoiceLineItemUpdated::class);
});

it('partial updates an invoices line item', function () {
    Event::fake([InvoiceLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '3', 'price' => '500.00', 'total' => '1500.00']);

    $li = LaravelWafeq::invoicesLineItems()->partialUpdate('ili_1', ['quantity' => '3']);

    expect($li->quantity)->toBe('3');

    Event::assertDispatched(InvoiceLineItemPartiallyUpdated::class);
});

it('destroys an invoices line item', function () {
    Event::fake([InvoiceLineItemDestroyed::class]);
    $this->fakeWafeq('/invoices/line-items/ili_1/', '', 204);

    expect(LaravelWafeq::invoicesLineItems()->destroy('ili_1'))->toBeTrue();

    Event::assertDispatched(InvoiceLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/invoices/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::invoicesLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(InvoiceLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
