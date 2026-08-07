<?php

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists items', function () {
    $this->fakeWafeqPage('/items/', [
        ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '250.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::items()->list();

    expect($page->results[0])->toBeInstanceOf(ItemData::class)
        ->and($page->results[0]->sku)->toBe('CONS-001');
});

it('creates an item', function () {
    $this->fakeWafeq('/items/', ['id' => 'it_new', 'name' => 'New Item', 'sku' => 'NEW-001', 'type' => 'PRODUCT', 'unitPrice' => '100.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->create([
        'name' => 'New Item',
        'sku' => 'NEW-001',
        'type' => 'PRODUCT',
        'unit_price' => '100.00',
        'currency' => 'SAR',
    ]);

    expect($item->id)->toBe('it_new');
});

it('retrieves an item', function () {
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '250.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->retrieve('it_1');

    expect($item->id)->toBe('it_1');
});

it('updates an item', function () {
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Renamed', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '300.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->update('it_1', ['name' => 'Renamed', 'unit_price' => '300.00']);

    expect($item->name)->toBe('Renamed')
        ->and($item->unitPrice)->toBe('300.00');
});

it('partial updates an item', function () {
    $this->fakeWafeq('/items/it_1/', ['id' => 'it_1', 'name' => 'Consulting Hour', 'sku' => 'CONS-001', 'type' => 'SERVICE', 'unitPrice' => '350.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::items()->partialUpdate('it_1', ['unit_price' => '350.00']);

    expect($item->unitPrice)->toBe('350.00');
});

it('destroys an item', function () {
    $this->fakeWafeq('/items/it_1/', '', 204);

    expect(LaravelWafeq::items()->destroy('it_1'))->toBeTrue();
});
