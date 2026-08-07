<?php

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists custom fields', function () {
    $this->fakeWafeqPage('/custom-fields/', [
        ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true],
    ]);

    $page = LaravelWafeq::customFields()->list();

    expect($page->results[0])->toBeInstanceOf(CustomFieldData::class)
        ->and($page->results[0]->isRequired)->toBeTrue();
});

it('creates a custom field', function () {
    $this->fakeWafeq('/custom-fields/', ['id' => 'cf_new', 'name' => 'Department', 'fieldType' => 'TEXT', 'resourceType' => 'CONTACT', 'isRequired' => false]);

    $cf = LaravelWafeq::customFields()->create([
        'name' => 'Department',
        'field_type' => 'TEXT',
        'resource_type' => 'CONTACT',
        'is_required' => false,
    ]);

    expect($cf->id)->toBe('cf_new');
});

it('retrieves a custom field', function () {
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true]);

    $cf = LaravelWafeq::customFields()->retrieve('cf_1');

    expect($cf->id)->toBe('cf_1');
});

it('updates a custom field', function () {
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Renamed', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true]);

    $cf = LaravelWafeq::customFields()->update('cf_1', ['name' => 'Renamed']);

    expect($cf->name)->toBe('Renamed');
});

it('partial updates a custom field', function () {
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => false]);

    $cf = LaravelWafeq::customFields()->partialUpdate('cf_1', ['is_required' => false]);

    expect($cf->isRequired)->toBeFalse();
});

it('destroys a custom field', function () {
    $this->fakeWafeq('/custom-fields/cf_1/', '', 204);

    expect(LaravelWafeq::customFields()->destroy('cf_1'))->toBeTrue();
});
