<?php

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists units of measure', function () {
    $this->fakeWafeqPage('/units-of-measure/', [
        ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'kg'],
    ]);

    $page = LaravelWafeq::unitsOfMeasure()->list();

    expect($page->results[0])->toBeInstanceOf(UnitOfMeasureData::class)
        ->and($page->results[0]->abbreviation)->toBe('kg');
});

it('creates a unit of measure', function () {
    $this->fakeWafeq('/units-of-measure/', ['id' => 'uom_new', 'name' => 'Liter', 'abbreviation' => 'l']);

    $uom = LaravelWafeq::unitsOfMeasure()->create(['name' => 'Liter', 'abbreviation' => 'l']);

    expect($uom->id)->toBe('uom_new');
});

it('retrieves a unit of measure', function () {
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'kg']);

    $uom = LaravelWafeq::unitsOfMeasure()->retrieve('uom_1');

    expect($uom->id)->toBe('uom_1');
});

it('updates a unit of measure', function () {
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'KG']);

    $uom = LaravelWafeq::unitsOfMeasure()->update('uom_1', ['abbreviation' => 'KG']);

    expect($uom->abbreviation)->toBe('KG');
});

it('partial updates a unit of measure', function () {
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilo', 'abbreviation' => 'kg']);

    $uom = LaravelWafeq::unitsOfMeasure()->partialUpdate('uom_1', ['name' => 'Kilo']);

    expect($uom->name)->toBe('Kilo');
});

it('destroys a unit of measure', function () {
    $this->fakeWafeq('/units-of-measure/uom_1/', '', 204);

    expect(LaravelWafeq::unitsOfMeasure()->destroy('uom_1'))->toBeTrue();
});
