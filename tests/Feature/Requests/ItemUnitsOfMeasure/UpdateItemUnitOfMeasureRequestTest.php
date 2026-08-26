<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\ItemUnitsOfMeasure\UpdateItemUnitOfMeasureRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated item-unit-of-measure update payload', function () {
    $payload = [
        'item' => 'item_abc',
        'unit_of_measure' => 'uom_kg',
        'conversion_factor' => 2.0,
        'unit_price' => 24.95,
    ];

    $request = UpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ItemUnitOfMeasureData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ItemUnitOfMeasureData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('conversion_factor'))->toBeTrue()
        ->and($validator->errors()->has('item'))->toBeTrue()
        ->and($validator->errors()->has('unit_of_measure'))->toBeTrue();
});

it('rejects a non-numeric unit_cost', function () {
    $request = UpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['unit_cost' => 'cheap'],
        ['unit_cost' => $request->rules()['unit_cost']],
    );

    expect($validator->fails())->toBeTrue();
});
