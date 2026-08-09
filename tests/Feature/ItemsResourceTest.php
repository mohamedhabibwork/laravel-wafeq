<?php

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Items\ItemCreated;
use HWafeq\LaravelWafeq\Events\Items\ItemDestroyed;
use HWafeq\LaravelWafeq\Events\Items\ItemListed;
use HWafeq\LaravelWafeq\Events\Items\ItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Items\ItemRetrieved;
use HWafeq\LaravelWafeq\Events\Items\ItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists items', function () {
    Event::fake([ItemListed::class]);
    $this->fakeWafeqPage('/items/', [
        ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '250.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::items()->list();

    expect($page->results[0])->toBeInstanceOf(ItemData::class)
        ->and($page->results[0]->sku)->toBe('CONS-001');

    Event::assertDispatched(ItemListed::class);
});

it('creates an item', function () {
    Event::fake([ItemCreated::class]);
    $this->fakeWafeq('/items/', ['id' => 'it_new', 'name' => 'New Item', 'sku' => 'NEW-001', 'type' => 'PRODUCT', 'unitPrice' => '100.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->create([
        'name' => 'New Item',
        'sku' => 'NEW-001',
        'type' => 'PRODUCT',
        'unit_price' => '100.00',
        'currency' => 'SAR',
    ]);

    expect($item->id)->toBe('it_new');

    Event::assertDispatched(ItemCreated::class);
});

it('retrieves an item', function () {
    Event::fake([ItemRetrieved::class]);
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '250.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->retrieve('it_1');

    expect($item->id)->toBe('it_1');

    Event::assertDispatched(ItemRetrieved::class);
});

it('updates an item', function () {
    Event::fake([ItemUpdated::class]);
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Renamed', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '300.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->update('it_1', ['name' => 'Renamed', 'unit_price' => '300.00']);

    expect($item->name)->toBe('Renamed')
        ->and($item->unitPrice)->toBe('300.00');

    Event::assertDispatched(ItemUpdated::class);
});

it('partial updates an item', function () {
    Event::fake([ItemPartiallyUpdated::class]);
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '350.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->partialUpdate('it_1', ['unit_price' => '350.00']);

    expect($item->unitPrice)->toBe('350.00');

    Event::assertDispatched(ItemPartiallyUpdated::class);
});

it('destroys an item', function () {
    Event::fake([ItemDestroyed::class]);
    $this->fakeWafeq('/items/it_1/', '', 204);

    expect(LaravelWafeq::items()->destroy('it_1'))->toBeTrue();

    Event::assertDispatched(ItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::items()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ItemData::class)
        ->and($result->id)->toBe('m_1');
});
