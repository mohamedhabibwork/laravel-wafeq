<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\UnitsOfMeasure\UpdateUnitOfMeasureRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated unit of measure update payload', function () {
    $payload = [
        'name' => 'Gram',
        'name_ar' => 'جرام',
        'is_active' => true,
    ];

    $request = UpdateUnitOfMeasureRequest::create('/units-of-measure/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(UnitOfMeasureData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(UnitOfMeasureData::class);
});

it('rejects an update payload missing the name', function () {
    $request = UpdateUnitOfMeasureRequest::create('/units-of-measure/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects a non-boolean is_active value', function () {
    $request = UpdateUnitOfMeasureRequest::create('/units-of-measure/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['is_active' => 'maybe'],
        ['is_active' => $request->rules()['is_active']],
    );

    expect($validator->fails())->toBeTrue();
});
