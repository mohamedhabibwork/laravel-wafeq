<?php

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists branches', function () {
    $this->fakeWafeqPage('/branches/', [
        ['id' => 'br_1', 'name' => 'Riyadh HQ', 'code' => 'RYD', 'country' => 'SA', 'city' => 'Riyadh'],
    ]);

    $page = LaravelWafeq::branches()->list();

    expect($page->results[0])->toBeInstanceOf(BranchData::class)
        ->and($page->results[0]->city)->toBe('Riyadh');
});

it('creates a branch', function () {
    $this->fakeWafeq('/branches/', ['id' => 'br_new', 'name' => 'Jeddah', 'code' => 'JED', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->create(['name' => 'Jeddah', 'code' => 'JED', 'country' => 'SA']);

    expect($branch->id)->toBe('br_new');
});

it('retrieves a branch', function () {
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Riyadh HQ', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->retrieve('br_1');

    expect($branch->id)->toBe('br_1');
});

it('updates a branch', function () {
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Renamed', 'country' => 'SA']);

    $branch = LaravelWafeq::branches()->update('br_1', ['name' => 'Renamed']);

    expect($branch->name)->toBe('Renamed');
});

it('partial updates a branch', function () {
    $this->fakeWafeq('/branches/br_1/', ['id' => 'br_1', 'name' => 'Riyadh HQ', 'country' => 'AE']);

    $branch = LaravelWafeq::branches()->partialUpdate('br_1', ['country' => 'AE']);

    expect($branch->country)->toBe('AE');
});

it('destroys a branch', function () {
    $this->fakeWafeq('/branches/br_1/', '', 204);

    expect(LaravelWafeq::branches()->destroy('br_1'))->toBeTrue();
});
