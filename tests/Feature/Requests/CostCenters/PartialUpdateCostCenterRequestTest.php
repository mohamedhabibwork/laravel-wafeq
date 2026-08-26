<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\CostCenters\PartialUpdateCostCenterRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateCostCenterRequest::create('/cost-centers/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CostCenterData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = ['is_active' => false];

    $request = PartialUpdateCostCenterRequest::create('/cost-centers/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CostCenterData::class);
});

it('rejects an over-long name on partial update', function () {
    $request = PartialUpdateCostCenterRequest::create('/cost-centers/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name_en' => str_repeat('a', 201)],
        ['name_en' => $request->rules()['name_en']],
    );

    expect($validator->fails())->toBeTrue();
});
