<?php

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemCreated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemListed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists simplified invoices line items', function () {
    Event::fake([SimplifiedInvoiceLineItemListed::class]);
    $this->fakeWafeqPage('/simplified-invoices/line-items/', [
        ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::simplifiedInvoicesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(SimplifiedInvoiceLineItemData::class);

    Event::assertDispatched(SimplifiedInvoiceLineItemListed::class);
});

it('creates a simplified invoices line item', function () {
    Event::fake([SimplifiedInvoiceLineItemCreated::class]);
    $this->fakeWafeq('/simplified-invoices/line-items/', ['id' => 'sili_new', 'name' => 'Item', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->create([
        'simplified_invoice' => 'si_1',
        'name' => 'Item',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('sili_new');

    Event::assertDispatched(SimplifiedInvoiceLineItemCreated::class);
});

it('retrieves a simplified invoices line item', function () {
    Event::fake([SimplifiedInvoiceLineItemRetrieved::class]);
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->retrieve('sili_1');

    expect($li->id)->toBe('sili_1');

    Event::assertDispatched(SimplifiedInvoiceLineItemRetrieved::class);
});

it('updates a simplified invoices line item', function () {
    Event::fake([SimplifiedInvoiceLineItemUpdated::class]);
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->update('sili_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(SimplifiedInvoiceLineItemUpdated::class);
});

it('partial updates a simplified invoices line item', function () {
    Event::fake([SimplifiedInvoiceLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '2', 'price' => '50.00', 'total' => '100.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->partialUpdate('sili_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');

    Event::assertDispatched(SimplifiedInvoiceLineItemPartiallyUpdated::class);
});

it('destroys a simplified invoices line item', function () {
    Event::fake([SimplifiedInvoiceLineItemDestroyed::class]);
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', '', 204);

    expect(LaravelWafeq::simplifiedInvoicesLineItems()->destroy('sili_1'))->toBeTrue();

    Event::assertDispatched(SimplifiedInvoiceLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::simplifiedInvoicesLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(SimplifiedInvoiceLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
