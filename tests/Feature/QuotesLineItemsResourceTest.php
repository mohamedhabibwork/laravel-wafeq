<?php

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemListed;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists quotes line items', function () {
    Event::fake([QuoteLineItemListed::class]);
    $this->fakeWafeqPage('/quotes/line-items/', [
        ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::quotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(QuoteLineItemData::class);

    Event::assertDispatched(QuoteLineItemListed::class);
});

it('creates a quotes line item', function () {
    Event::fake([QuoteLineItemCreated::class]);
    $this->fakeWafeq('/quotes/line-items/', ['id' => 'qli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::quotesLineItems()->create([
        'quote' => 'q_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('qli_new');

    Event::assertDispatched(QuoteLineItemCreated::class);
});

it('retrieves a quotes line item', function () {
    Event::fake([QuoteLineItemRetrieved::class]);
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00']);

    $li = LaravelWafeq::quotesLineItems()->retrieve('qli_1');

    expect($li->id)->toBe('qli_1');

    Event::assertDispatched(QuoteLineItemRetrieved::class);
});

it('updates a quotes line item', function () {
    Event::fake([QuoteLineItemUpdated::class]);
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00']);

    $li = LaravelWafeq::quotesLineItems()->update('qli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(QuoteLineItemUpdated::class);
});

it('partial updates a quotes line item', function () {
    Event::fake([QuoteLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '2', 'price' => '1000.00', 'total' => '2000.00']);

    $li = LaravelWafeq::quotesLineItems()->partialUpdate('qli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');

    Event::assertDispatched(QuoteLineItemPartiallyUpdated::class);
});

it('destroys a quotes line item', function () {
    Event::fake([QuoteLineItemDestroyed::class]);
    $this->fakeWafeq('/quotes/line-items/qli_1/', '', 204);

    expect(LaravelWafeq::quotesLineItems()->destroy('qli_1'))->toBeTrue();

    Event::assertDispatched(QuoteLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/quotes/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::quotesLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(QuoteLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
