<?php

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureCreated;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureDestroyed;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureListed;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasurePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureRetrieved;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists units of measure', function () {
    Event::fake([UnitOfMeasureListed::class]);
    $this->fakeWafeqPage('/units-of-measure/', [
        ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'kg'],
    ]);

    $page = LaravelWafeq::unitsOfMeasure()->list();

    expect($page->results[0])->toBeInstanceOf(UnitOfMeasureData::class)
        ->and($page->results[0]->abbreviation)->toBe('kg');

    Event::assertDispatched(UnitOfMeasureListed::class);
});

it('creates a unit of measure', function () {
    Event::fake([UnitOfMeasureCreated::class]);
    $this->fakeWafeq('/units-of-measure/', ['id' => 'uom_new', 'name' => 'Liter', 'abbreviation' => 'l']);

    $uom = LaravelWafeq::unitsOfMeasure()->create(['name' => 'Liter', 'abbreviation' => 'l']);

    expect($uom->id)->toBe('uom_new');

    Event::assertDispatched(UnitOfMeasureCreated::class);
});

it('retrieves a unit of measure', function () {
    Event::fake([UnitOfMeasureRetrieved::class]);
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'kg']);

    $uom = LaravelWafeq::unitsOfMeasure()->retrieve('uom_1');

    expect($uom->id)->toBe('uom_1');

    Event::assertDispatched(UnitOfMeasureRetrieved::class);
});

it('updates a unit of measure', function () {
    Event::fake([UnitOfMeasureUpdated::class]);
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilogram', 'abbreviation' => 'KG']);

    $uom = LaravelWafeq::unitsOfMeasure()->update('uom_1', ['abbreviation' => 'KG']);

    expect($uom->abbreviation)->toBe('KG');

    Event::assertDispatched(UnitOfMeasureUpdated::class);
});

it('partial updates a unit of measure', function () {
    Event::fake([UnitOfMeasurePartiallyUpdated::class]);
    $this->fakeWafeq('/units-of-measure/uom_1/', ['id' => 'uom_1', 'name' => 'Kilo', 'abbreviation' => 'kg']);

    $uom = LaravelWafeq::unitsOfMeasure()->partialUpdate('uom_1', ['name' => 'Kilo']);

    expect($uom->name)->toBe('Kilo');

    Event::assertDispatched(UnitOfMeasurePartiallyUpdated::class);
});

it('destroys a unit of measure', function () {
    Event::fake([UnitOfMeasureDestroyed::class]);
    $this->fakeWafeq('/units-of-measure/uom_1/', '', 204);

    expect(LaravelWafeq::unitsOfMeasure()->destroy('uom_1'))->toBeTrue();

    Event::assertDispatched(UnitOfMeasureDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/units-of-measure/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::unitsOfMeasure()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(UnitOfMeasureData::class)
        ->and($result->id)->toBe('m_1');
});
