<?php

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists item units of measure', function () {
    $this->fakeWafeqPage('/item-units-of-measure/', [
        ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'box'],
    ]);

    $page = LaravelWafeq::itemUnitsOfMeasure()->list();

    expect($page->results[0])->toBeInstanceOf(ItemUnitOfMeasureData::class)
        ->and($page->results[0]->abbreviation)->toBe('box');
});

it('creates an item unit of measure', function () {
    $this->fakeWafeq('/item-units-of-measure/', ['id' => 'iu_new', 'name' => 'Pallet', 'abbreviation' => 'plt']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->create(['name' => 'Pallet', 'abbreviation' => 'plt']);

    expect($iu->id)->toBe('iu_new');
});

it('retrieves an item unit of measure', function () {
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'box']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->retrieve('iu_1');

    expect($iu->id)->toBe('iu_1');
});

it('updates an item unit of measure', function () {
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'bx']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->update('iu_1', ['abbreviation' => 'bx']);

    expect($iu->abbreviation)->toBe('bx');
});

it('partial updates an item unit of measure', function () {
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Big Box', 'abbreviation' => 'box']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->partialUpdate('iu_1', ['name' => 'Big Box']);

    expect($iu->name)->toBe('Big Box');
});

it('destroys an item unit of measure', function () {
    $this->fakeWafeq('/item-units-of-measure/iu_1/', '', 204);

    expect(LaravelWafeq::itemUnitsOfMeasure()->destroy('iu_1'))->toBeTrue();
});
