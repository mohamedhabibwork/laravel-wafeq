<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\CostCenters\CreateCostCenterRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated cost center payload', function () {
    $payload = [
        'name_ar' => 'مركز عمليات',
        'name_en' => 'Operations Center',
        'is_active' => true,
    ];

    $request = CreateCostCenterRequest::create('/cost-centers/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(CostCenterData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a cost center payload missing required fields', function () {
    $request = CreateCostCenterRequest::create('/cost-centers/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name_ar'))->toBeTrue()
        ->and($validator->errors()->has('name_en'))->toBeTrue()
        ->and($validator->errors()->has('is_active'))->toBeTrue();
});

it('rejects an over-long localised name', function () {
    $request = CreateCostCenterRequest::create('/cost-centers/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name_en' => str_repeat('a', 201)],
        ['name_en' => $request->rules()['name_en']],
    );

    expect($validator->fails())->toBeTrue();
});
