<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\ItemUnitsOfMeasure\CreateItemUnitOfMeasureRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated item-unit-of-measure payload', function () {
    $payload = [
        'item' => 'item_abc',
        'unit_of_measure' => 'uom_kg',
        'conversion_factor' => 1.5,
        'is_active' => true,
        'is_base' => false,
        'is_default_purchase' => true,
        'is_default_sales' => false,
        'unit_cost' => 10.5,
        'unit_price' => 19.95,
    ];

    $request = CreateItemUnitOfMeasureRequest::create('/item-units-of-measure/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(ItemUnitOfMeasureData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an item-unit-of-measure payload missing required fields', function () {
    $request = CreateItemUnitOfMeasureRequest::create('/item-units-of-measure/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('conversion_factor'))->toBeTrue()
        ->and($validator->errors()->has('item'))->toBeTrue()
        ->and($validator->errors()->has('unit_of_measure'))->toBeTrue();
});

it('rejects a non-numeric conversion_factor', function () {
    $request = CreateItemUnitOfMeasureRequest::create('/item-units-of-measure/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['conversion_factor' => 'a-lot'],
        ['conversion_factor' => $request->rules()['conversion_factor']],
    );

    expect($validator->fails())->toBeTrue();
});
