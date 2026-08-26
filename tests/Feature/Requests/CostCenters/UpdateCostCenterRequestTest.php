<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\CostCenters\UpdateCostCenterRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated cost center update payload', function () {
    $payload = [
        'name_ar' => 'مركز عمليات',
        'name_en' => 'Operations Center',
        'is_active' => false,
    ];

    $request = UpdateCostCenterRequest::create('/cost-centers/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CostCenterData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CostCenterData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateCostCenterRequest::create('/cost-centers/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name_ar'))->toBeTrue()
        ->and($validator->errors()->has('name_en'))->toBeTrue()
        ->and($validator->errors()->has('is_active'))->toBeTrue();
});

it('rejects a non-boolean is_active value', function () {
    $request = UpdateCostCenterRequest::create('/cost-centers/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['is_active' => 'not-a-bool'],
        ['is_active' => $request->rules()['is_active']],
    );

    expect($validator->fails())->toBeTrue();
});
