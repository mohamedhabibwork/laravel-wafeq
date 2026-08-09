<?php

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureCreated;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureDestroyed;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureListed;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasurePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureRetrieved;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists item units of measure', function () {
    Event::fake([ItemUnitOfMeasureListed::class]);
    $this->fakeWafeqPage('/item-units-of-measure/', [
        ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'box'],
    ]);

    $page = LaravelWafeq::itemUnitsOfMeasure()->list();

    expect($page->results[0])->toBeInstanceOf(ItemUnitOfMeasureData::class)
        ->and($page->results[0]->abbreviation)->toBe('box');

    Event::assertDispatched(ItemUnitOfMeasureListed::class);
});

it('creates an item unit of measure', function () {
    Event::fake([ItemUnitOfMeasureCreated::class]);
    $this->fakeWafeq('/item-units-of-measure/', ['id' => 'iu_new', 'name' => 'Pallet', 'abbreviation' => 'plt']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->create(['name' => 'Pallet', 'abbreviation' => 'plt']);

    expect($iu->id)->toBe('iu_new');

    Event::assertDispatched(ItemUnitOfMeasureCreated::class);
});

it('retrieves an item unit of measure', function () {
    Event::fake([ItemUnitOfMeasureRetrieved::class]);
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'box']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->retrieve('iu_1');

    expect($iu->id)->toBe('iu_1');

    Event::assertDispatched(ItemUnitOfMeasureRetrieved::class);
});

it('updates an item unit of measure', function () {
    Event::fake([ItemUnitOfMeasureUpdated::class]);
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Box', 'abbreviation' => 'bx']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->update('iu_1', ['abbreviation' => 'bx']);

    expect($iu->abbreviation)->toBe('bx');

    Event::assertDispatched(ItemUnitOfMeasureUpdated::class);
});

it('partial updates an item unit of measure', function () {
    Event::fake([ItemUnitOfMeasurePartiallyUpdated::class]);
    $this->fakeWafeq('/item-units-of-measure/iu_1/', ['id' => 'iu_1', 'name' => 'Big Box', 'abbreviation' => 'box']);

    $iu = LaravelWafeq::itemUnitsOfMeasure()->partialUpdate('iu_1', ['name' => 'Big Box']);

    expect($iu->name)->toBe('Big Box');

    Event::assertDispatched(ItemUnitOfMeasurePartiallyUpdated::class);
});

it('destroys an item unit of measure', function () {
    Event::fake([ItemUnitOfMeasureDestroyed::class]);
    $this->fakeWafeq('/item-units-of-measure/iu_1/', '', 204);

    expect(LaravelWafeq::itemUnitsOfMeasure()->destroy('iu_1'))->toBeTrue();

    Event::assertDispatched(ItemUnitOfMeasureDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/item-units-of-measure/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::itemUnitsOfMeasure()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ItemUnitOfMeasureData::class)
        ->and($result->id)->toBe('m_1');
});
