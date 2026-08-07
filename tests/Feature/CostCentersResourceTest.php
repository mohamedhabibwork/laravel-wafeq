<?php

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists cost centers', function () {
    $this->fakeWafeqPage('/cost-centers/', [
        ['id' => 'cc_1', 'name' => 'Marketing', 'code' => 'MKT', 'description' => 'Marketing dept'],
    ]);

    $page = LaravelWafeq::costCenters()->list();

    expect($page->results[0])->toBeInstanceOf(CostCenterData::class)
        ->and($page->results[0]->code)->toBe('MKT');
});

it('creates a cost center', function () {
    $this->fakeWafeq('/cost-centers/', ['id' => 'cc_new', 'name' => 'Engineering', 'code' => 'ENG']);

    $cc = LaravelWafeq::costCenters()->create(['name' => 'Engineering', 'code' => 'ENG']);

    expect($cc->id)->toBe('cc_new');
});

it('retrieves a cost center', function () {
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Marketing', 'code' => 'MKT']);

    $cc = LaravelWafeq::costCenters()->retrieve('cc_1');

    expect($cc->id)->toBe('cc_1');
});

it('updates a cost center', function () {
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Renamed', 'code' => 'MKT']);

    $cc = LaravelWafeq::costCenters()->update('cc_1', ['name' => 'Renamed']);

    expect($cc->name)->toBe('Renamed');
});

it('partial updates a cost center', function () {
    $this->fakeWafeq('/cost-centers/cc_1/', ['id' => 'cc_1', 'name' => 'Marketing', 'description' => 'Updated']);

    $cc = LaravelWafeq::costCenters()->partialUpdate('cc_1', ['description' => 'Updated']);

    expect($cc->description)->toBe('Updated');
});

it('destroys a cost center', function () {
    $this->fakeWafeq('/cost-centers/cc_1/', '', 204);

    expect(LaravelWafeq::costCenters()->destroy('cc_1'))->toBeTrue();
});
