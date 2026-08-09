<?php

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseCreated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseDestroyed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseListed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehousePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseRetrieved;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists warehouses', function () {
    Event::fake([WarehouseListed::class]);
    $this->fakeWafeqPage('/warehouses/', [
        ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'city' => 'Riyadh', 'country' => 'SA'],
    ]);

    $page = LaravelWafeq::warehouses()->list();

    expect($page->results[0])->toBeInstanceOf(WarehouseData::class)
        ->and($page->results[0]->code)->toBe('WH-001');

    Event::assertDispatched(WarehouseListed::class);
});

it('creates a warehouse', function () {
    Event::fake([WarehouseCreated::class]);
    $this->fakeWafeq('/warehouses/', ['id' => 'w_new', 'name' => 'Secondary Warehouse', 'code' => 'WH-002', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->create([
        'name' => 'Secondary Warehouse',
        'code' => 'WH-002',
        'country' => 'SA',
    ]);

    expect($w->id)->toBe('w_new');

    Event::assertDispatched(WarehouseCreated::class);
});

it('retrieves a warehouse', function () {
    Event::fake([WarehouseRetrieved::class]);
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->retrieve('w_1');

    expect($w->id)->toBe('w_1');

    Event::assertDispatched(WarehouseRetrieved::class);
});

it('updates a warehouse', function () {
    Event::fake([WarehouseUpdated::class]);
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Renamed', 'code' => 'WH-001', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->update('w_1', ['name' => 'Renamed']);

    expect($w->name)->toBe('Renamed');

    Event::assertDispatched(WarehouseUpdated::class);
});

it('partial updates a warehouse', function () {
    Event::fake([WarehousePartiallyUpdated::class]);
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'country' => 'AE']);

    $w = LaravelWafeq::warehouses()->partialUpdate('w_1', ['country' => 'AE']);

    expect($w->country)->toBe('AE');

    Event::assertDispatched(WarehousePartiallyUpdated::class);
});

it('destroys a warehouse', function () {
    Event::fake([WarehouseDestroyed::class]);
    $this->fakeWafeq('/warehouses/w_1/', '', 204);

    expect(LaravelWafeq::warehouses()->destroy('w_1'))->toBeTrue();

    Event::assertDispatched(WarehouseDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/warehouses/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::warehouses()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(WarehouseData::class)
        ->and($result->id)->toBe('m_1');
});
