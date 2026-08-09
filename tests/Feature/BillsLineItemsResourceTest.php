<?php

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemCreated;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemListed;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists bills line items', function () {
    Event::fake([BillLineItemListed::class]);
    $this->fakeWafeqPage('/bills/line-items/', [
        ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::billsLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(BillLineItemData::class)
        ->and($page->results[0]->name)->toBe('Consulting');

    Event::assertDispatched(BillLineItemListed::class);
});

it('creates a bills line item', function () {
    Event::fake([BillLineItemCreated::class]);
    $this->fakeWafeq('/bills/line-items/', ['id' => 'bli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::billsLineItems()->create([
        'bill' => 'b_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('bli_new');

    Event::assertDispatched(BillLineItemCreated::class);
});

it('retrieves a bills line item', function () {
    Event::fake([BillLineItemRetrieved::class]);
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00']);

    $li = LaravelWafeq::billsLineItems()->retrieve('bli_1');

    expect($li->id)->toBe('bli_1');

    Event::assertDispatched(BillLineItemRetrieved::class);
});

it('updates a bills line item', function () {
    Event::fake([BillLineItemUpdated::class]);
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Updated', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00']);

    $li = LaravelWafeq::billsLineItems()->update('bli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(BillLineItemUpdated::class);
});

it('partial updates a bills line item', function () {
    Event::fake([BillLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '20', 'price' => '100.00', 'total' => '2000.00']);

    $li = LaravelWafeq::billsLineItems()->partialUpdate('bli_1', ['quantity' => '20']);

    expect($li->quantity)->toBe('20');

    Event::assertDispatched(BillLineItemPartiallyUpdated::class);
});

it('destroys a bills line item', function () {
    Event::fake([BillLineItemDestroyed::class]);
    $this->fakeWafeq('/bills/line-items/bli_1/', '', 204);

    expect(LaravelWafeq::billsLineItems()->destroy('bli_1'))->toBeTrue();

    Event::assertDispatched(BillLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/bills/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::billsLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BillLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
