<?php

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterCreated;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterDestroyed;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterListed;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterRetrieved;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists cost centers', function () {
    Event::fake([CostCenterListed::class]);
    $this->fakeWafeqPage('/cost-centers/', [
        ['id' => 'cc_1', 'name' => 'Marketing', 'code' => 'MKT', 'description' => 'Marketing dept'],
    ]);

    $page = LaravelWafeq::costCenters()->list();

    expect($page->results[0])->toBeInstanceOf(CostCenterData::class)
        ->and($page->results[0]->code)->toBe('MKT');

    Event::assertDispatched(CostCenterListed::class);
});

it('creates a cost center', function () {
    Event::fake([CostCenterCreated::class]);
    $this->fakeWafeq('/cost-centers/', ['id' => 'cc_new', 'name' => 'Engineering', 'code' => 'ENG']);

    $cc = LaravelWafeq::costCenters()->create(['name' => 'Engineering', 'code' => 'ENG']);

    expect($cc->id)->toBe('cc_new');

    Event::assertDispatched(CostCenterCreated::class);
});

it('retrieves a cost center', function () {
    Event::fake([CostCenterRetrieved::class]);
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Marketing', 'code' => 'MKT']);

    $cc = LaravelWafeq::costCenters()->retrieve('cc_1');

    expect($cc->id)->toBe('cc_1');

    Event::assertDispatched(CostCenterRetrieved::class);
});

it('updates a cost center', function () {
    Event::fake([CostCenterUpdated::class]);
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Renamed', 'code' => 'MKT']);

    $cc = LaravelWafeq::costCenters()->update('cc_1', ['name' => 'Renamed']);

    expect($cc->name)->toBe('Renamed');

    Event::assertDispatched(CostCenterUpdated::class);
});

it('partial updates a cost center', function () {
    Event::fake([CostCenterPartiallyUpdated::class]);
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Marketing', 'description' => 'Updated']);

    $cc = LaravelWafeq::costCenters()->partialUpdate('cc_1', ['description' => 'Updated']);

    expect($cc->description)->toBe('Updated');

    Event::assertDispatched(CostCenterPartiallyUpdated::class);
});

it('destroys a cost center', function () {
    Event::fake([CostCenterDestroyed::class]);
    $this->fakeWafeq('/cost-centers/cc_1/', '', 204);

    expect(LaravelWafeq::costCenters()->destroy('cc_1'))->toBeTrue();

    Event::assertDispatched(CostCenterDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/cost-centers/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::costCenters()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(CostCenterData::class)
        ->and($result->id)->toBe('m_1');
});
