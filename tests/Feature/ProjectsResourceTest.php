<?php

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists projects', function () {
    $this->fakeWafeqPage('/projects/', [
        ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'ACTIVE', 'startDate' => '2024-01-01', 'endDate' => '2024-06-30', 'customer' => 'c_1'],
    ]);

    $page = LaravelWafeq::projects()->list();

    expect($page->results[0])->toBeInstanceOf(ProjectData::class)
        ->and($page->results[0]->status)->toBe('ACTIVE');
});

it('creates a project', function () {
    $this->fakeWafeq('/projects/', ['id' => 'p_new', 'name' => 'New Project', 'status' => 'ACTIVE', 'currency' => 'SAR']);

    $p = LaravelWafeq::projects()->create([
        'name' => 'New Project',
        'start_date' => '2024-01-01',
        'customer' => 'c_1',
    ]);

    expect($p->id)->toBe('p_new');
});

it('retrieves a project', function () {
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'ACTIVE']);

    $p = LaravelWafeq::projects()->retrieve('p_1');

    expect($p->id)->toBe('p_1');
});

it('updates a project', function () {
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Renamed', 'status' => 'ACTIVE']);

    $p = LaravelWafeq::projects()->update('p_1', ['name' => 'Renamed']);

    expect($p->name)->toBe('Renamed');
});

it('partial updates a project', function () {
    $this->fakeWafeq('/projects/p_1/', ['id' => 'p_1', 'name' => 'Acme Migration', 'status' => 'COMPLETED']);

    $p = LaravelWafeq::projects()->partialUpdate('p_1', ['status' => 'COMPLETED']);

    expect($p->status)->toBe('COMPLETED');
});

it('destroys a project', function () {
    $this->fakeWafeq('/projects/p_1/', '', 204);

    expect(LaravelWafeq::projects()->destroy('p_1'))->toBeTrue();
});
