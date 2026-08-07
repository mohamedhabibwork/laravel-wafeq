<?php

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists warehouses', function () {
    $this->fakeWafeqPage('/warehouses/', [
        ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'city' => 'Riyadh', 'country' => 'SA'],
    ]);

    $page = LaravelWafeq::warehouses()->list();

    expect($page->results[0])->toBeInstanceOf(WarehouseData::class)
        ->and($page->results[0]->code)->toBe('WH-001');
});

it('creates a warehouse', function () {
    $this->fakeWafeq('/warehouses/', ['id' => 'w_new', 'name' => 'Secondary Warehouse', 'code' => 'WH-002', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->create([
        'name' => 'Secondary Warehouse',
        'code' => 'WH-002',
        'country' => 'SA',
    ]);

    expect($w->id)->toBe('w_new');
});

it('retrieves a warehouse', function () {
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->retrieve('w_1');

    expect($w->id)->toBe('w_1');
});

it('updates a warehouse', function () {
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Renamed', 'code' => 'WH-001', 'country' => 'SA']);

    $w = LaravelWafeq::warehouses()->update('w_1', ['name' => 'Renamed']);

    expect($w->name)->toBe('Renamed');
});

it('partial updates a warehouse', function () {
    $this->fakeWafeq('/warehouses/w_1/', ['id' => 'w_1', 'name' => 'Main Warehouse', 'code' => 'WH-001', 'country' => 'AE']);

    $w = LaravelWafeq::warehouses()->partialUpdate('w_1', ['country' => 'AE']);

    expect($w->country)->toBe('AE');
});

it('destroys a warehouse', function () {
    $this->fakeWafeq('/warehouses/w_1/', '', 204);

    expect(LaravelWafeq::warehouses()->destroy('w_1'))->toBeTrue();
});
