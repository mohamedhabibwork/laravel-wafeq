<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\UnitsOfMeasure\CreateUnitOfMeasureRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated unit of measure payload', function () {
    $payload = [
        'name' => 'Kilogram',
        'name_ar' => 'كيلوجرام',
        'is_active' => true,
    ];

    $request = CreateUnitOfMeasureRequest::create('/units-of-measure/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(UnitOfMeasureData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a unit of measure payload missing the name', function () {
    $request = CreateUnitOfMeasureRequest::create('/units-of-measure/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an over-long name', function () {
    $request = CreateUnitOfMeasureRequest::create('/units-of-measure/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name' => str_repeat('a', 201)],
        ['name' => $request->rules()['name']],
    );

    expect($validator->fails())->toBeTrue();
});
