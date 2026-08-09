<?php

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Projects\ProjectCreated;
use HWafeq\LaravelWafeq\Events\Projects\ProjectDestroyed;
use HWafeq\LaravelWafeq\Events\Projects\ProjectListed;
use HWafeq\LaravelWafeq\Events\Projects\ProjectPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Projects\ProjectRetrieved;
use HWafeq\LaravelWafeq\Events\Projects\ProjectUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists projects', function () {
    Event::fake([ProjectListed::class]);
    $this->fakeWafeqPage('/projects/', [
        ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'ACTIVE', 'startDate' => '2024-01-01', 'endDate' => '2024-06-30', 'customer' => 'c_1'],
    ]);

    $page = LaravelWafeq::projects()->list();

    expect($page->results[0])->toBeInstanceOf(ProjectData::class)
        ->and($page->results[0]->status)->toBe('ACTIVE');

    Event::assertDispatched(ProjectListed::class);
});

it('creates a project', function () {
    Event::fake([ProjectCreated::class]);
    $this->fakeWafeq('/projects/', ['id' => 'p_new', 'name' => 'New Project', 'status' => 'ACTIVE', 'currency' => 'SAR']);

    $p = LaravelWafeq::projects()->create([
        'name' => 'New Project',
        'start_date' => '2024-01-01',
        'customer' => 'c_1',
    ]);

    expect($p->id)->toBe('p_new');

    Event::assertDispatched(ProjectCreated::class);
});

it('retrieves a project', function () {
    Event::fake([ProjectRetrieved::class]);
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'ACTIVE']);

    $p = LaravelWafeq::projects()->retrieve('p_1');

    expect($p->id)->toBe('p_1');

    Event::assertDispatched(ProjectRetrieved::class);
});

it('updates a project', function () {
    Event::fake([ProjectUpdated::class]);
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Renamed', 'status' => 'ACTIVE']);

    $p = LaravelWafeq::projects()->update('p_1', ['name' => 'Renamed']);

    expect($p->name)->toBe('Renamed');

    Event::assertDispatched(ProjectUpdated::class);
});

it('partial updates a project', function () {
    Event::fake([ProjectPartiallyUpdated::class]);
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'COMPLETED']);

    $p = LaravelWafeq::projects()->partialUpdate('p_1', ['status' => 'COMPLETED']);

    expect($p->status)->toBe('COMPLETED');

    Event::assertDispatched(ProjectPartiallyUpdated::class);
});

it('destroys a project', function () {
    Event::fake([ProjectDestroyed::class]);
    $this->fakeWafeq('/projects/p_1/', '', 204);

    expect(LaravelWafeq::projects()->destroy('p_1'))->toBeTrue();

    Event::assertDispatched(ProjectDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/projects/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::projects()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ProjectData::class)
        ->and($result->id)->toBe('m_1');
});
