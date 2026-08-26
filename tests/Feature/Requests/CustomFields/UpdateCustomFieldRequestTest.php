<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Requests\CustomFields\UpdateCustomFieldRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated custom field update payload', function () {
    $payload = [
        'apply_to' => ['CONTACTS'],
        'config' => ['field_type' => 'TEXT'],
        'is_active' => true,
        'name' => 'Customer Ref',
    ];

    $request = UpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CustomFieldData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CustomFieldData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('apply_to'))->toBeTrue()
        ->and($validator->errors()->has('config'))->toBeTrue();
});

it('rejects an invalid config field_type', function () {
    $request = UpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['config' => ['field_type' => 'INVALID']],
        ['config' => $request->rules()['config'], 'config.field_type' => $request->rules()['config.field_type']],
    );

    expect($validator->fails())->toBeTrue();
});
