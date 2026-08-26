<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Requests\CustomFields\CreateCustomFieldRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated custom field payload', function () {
    $payload = [
        'apply_to' => ['SALES', 'PURCHASES'],
        'config' => [
            'field_type' => 'SELECT',
            'metadata' => [
                'choices' => [
                    ['label' => 'Low', 'value' => 'low'],
                    ['label' => 'High', 'value' => 'high'],
                ],
            ],
        ],
        'is_active' => true,
        'is_line_item_field' => false,
        'is_visible' => true,
        'name' => 'Priority',
        'name_ar' => 'الأولوية',
    ];

    $request = CreateCustomFieldRequest::create('/custom-fields/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(CustomFieldData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a custom field payload missing required fields', function () {
    $request = CreateCustomFieldRequest::create('/custom-fields/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('apply_to'))->toBeTrue()
        ->and($validator->errors()->has('config'))->toBeTrue();
});

it('rejects an invalid apply_to entry', function () {
    $request = CreateCustomFieldRequest::create('/custom-fields/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['apply_to' => ['NOPE']],
        ['apply_to' => $request->rules()['apply_to'], 'apply_to.*' => $request->rules()['apply_to.*']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an invalid config field_type', function () {
    $request = CreateCustomFieldRequest::create('/custom-fields/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['config' => ['field_type' => 'NOPE']],
        ['config' => $request->rules()['config'], 'config.field_type' => $request->rules()['config.field_type']],
    );

    expect($validator->fails())->toBeTrue();
});
