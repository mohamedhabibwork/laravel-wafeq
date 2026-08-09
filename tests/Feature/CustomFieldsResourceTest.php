<?php

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldCreated;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldDestroyed;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldListed;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldRetrieved;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists custom fields', function () {
    Event::fake([CustomFieldListed::class]);
    $this->fakeWafeqPage('/custom-fields/', [
        ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true],
    ]);

    $page = LaravelWafeq::customFields()->list();

    expect($page->results[0])->toBeInstanceOf(CustomFieldData::class)
        ->and($page->results[0]->isRequired)->toBeTrue();

    Event::assertDispatched(CustomFieldListed::class);
});

it('creates a custom field', function () {
    Event::fake([CustomFieldCreated::class]);
    $this->fakeWafeq('/custom-fields/', ['id' => 'cf_new', 'name' => 'Department', 'fieldType' => 'TEXT', 'resourceType' => 'CONTACT', 'isRequired' => false]);

    $cf = LaravelWafeq::customFields()->create([
        'name' => 'Department',
        'field_type' => 'TEXT',
        'resource_type' => 'CONTACT',
        'is_required' => false,
    ]);

    expect($cf->id)->toBe('cf_new');

    Event::assertDispatched(CustomFieldCreated::class);
});

it('retrieves a custom field', function () {
    Event::fake([CustomFieldRetrieved::class]);
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true]);

    $cf = LaravelWafeq::customFields()->retrieve('cf_1');

    expect($cf->id)->toBe('cf_1');

    Event::assertDispatched(CustomFieldRetrieved::class);
});

it('updates a custom field', function () {
    Event::fake([CustomFieldUpdated::class]);
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Renamed', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => true]);

    $cf = LaravelWafeq::customFields()->update('cf_1', ['name' => 'Renamed']);

    expect($cf->name)->toBe('Renamed');

    Event::assertDispatched(CustomFieldUpdated::class);
});

it('partial updates a custom field', function () {
    Event::fake([CustomFieldPartiallyUpdated::class]);
    $this->fakeWafeq('/custom-fields/cf_1/', ['id' => 'cf_1', 'name' => 'Project Code', 'fieldType' => 'TEXT', 'resourceType' => 'INVOICE', 'isRequired' => false]);

    $cf = LaravelWafeq::customFields()->partialUpdate('cf_1', ['is_required' => false]);

    expect($cf->isRequired)->toBeFalse();

    Event::assertDispatched(CustomFieldPartiallyUpdated::class);
});

it('destroys a custom field', function () {
    Event::fake([CustomFieldDestroyed::class]);
    $this->fakeWafeq('/custom-fields/cf_1/', '', 204);

    expect(LaravelWafeq::customFields()->destroy('cf_1'))->toBeTrue();

    Event::assertDispatched(CustomFieldDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/custom-fields/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::customFields()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(CustomFieldData::class)
        ->and($result->id)->toBe('m_1');
});
