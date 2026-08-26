<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\ItemUnitsOfMeasure\PartialUpdateItemUnitOfMeasureRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ItemUnitOfMeasureData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'unit_price' => 29.95,
        'is_active' => false,
    ];

    $request = PartialUpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ItemUnitOfMeasureData::class);
});

it('rejects a non-numeric conversion_factor on partial update', function () {
    $request = PartialUpdateItemUnitOfMeasureRequest::create('/item-units-of-measure/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['conversion_factor' => 'much'],
        ['conversion_factor' => $request->rules()['conversion_factor']],
    );

    expect($validator->fails())->toBeTrue();
});
