<?php

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Branches\BranchCreated;
use HWafeq\LaravelWafeq\Events\Branches\BranchDestroyed;
use HWafeq\LaravelWafeq\Events\Branches\BranchListed;
use HWafeq\LaravelWafeq\Events\Branches\BranchPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Branches\BranchRetrieved;
use HWafeq\LaravelWafeq\Events\Branches\BranchUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists branches', function () {
    Event::fake([BranchListed::class]);
    $this->fakeWafeqPage('/branches/', [
        ['id' => 'br_1', 'name' => 'Riyadh HQ', 'code' => 'RYD', 'country' => 'SA', 'city' => 'Riyadh'],
    ]);

    $page = LaravelWafeq::branches()->list();

    expect($page->results[0])->toBeInstanceOf(BranchData::class)
        ->and($page->results[0]->city)->toBe('Riyadh');

    Event::assertDispatched(BranchListed::class);
});

it('creates a branch', function () {
    Event::fake([BranchCreated::class]);
    $this->fakeWafeq('/branches/', ['id' => 'br_new', 'name' => 'Jeddah', 'code' => 'JED', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->create(['name' => 'Jeddah', 'code' => 'JED', 'country' => 'SA']);

    expect($branch->id)->toBe('br_new');

    Event::assertDispatched(BranchCreated::class);
});

it('retrieves a branch', function () {
    Event::fake([BranchRetrieved::class]);
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Riyadh HQ', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->retrieve('br_1');

    expect($branch->id)->toBe('br_1');

    Event::assertDispatched(BranchRetrieved::class);
});

it('updates a branch', function () {
    Event::fake([BranchUpdated::class]);
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Renamed', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->update('br_1', ['name' => 'Renamed']);

    expect($branch->name)->toBe('Renamed');

    Event::assertDispatched(BranchUpdated::class);
});

it('partial updates a branch', function () {
    Event::fake([BranchPartiallyUpdated::class]);
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Riyadh HQ', 'country' => 'AE']);

    $branch = LaravelWafeq::branches()->partialUpdate('br_1', ['country' => 'AE']);

    expect($branch->country)->toBe('AE');

    Event::assertDispatched(BranchPartiallyUpdated::class);
});

it('destroys a branch', function () {
    Event::fake([BranchDestroyed::class]);
    $this->fakeWafeq('/branches/br_1/', '', 204);

    expect(LaravelWafeq::branches()->destroy('br_1'))->toBeTrue();

    Event::assertDispatched(BranchDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/branches/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::branches()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BranchData::class)
        ->and($result->id)->toBe('m_1');
});
