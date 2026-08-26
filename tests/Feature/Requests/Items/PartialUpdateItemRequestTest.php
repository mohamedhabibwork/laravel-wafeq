<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Requests\Items\PartialUpdateItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateItemRequest::create('/items/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ItemData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'unit_price' => 249.99,
        'is_active' => false,
    ];

    $request = PartialUpdateItemRequest::create('/items/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ItemData::class);
});

it('rejects a uom row missing the unit_of_measure id', function () {
    $request = PartialUpdateItemRequest::create('/items/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        [
            'item_units_of_measure' => [
                ['conversion_factor' => 1],
            ],
        ],
        [
            'item_units_of_measure' => $request->rules()['item_units_of_measure'],
            'item_units_of_measure.*' => $request->rules()['item_units_of_measure.*'],
            'item_units_of_measure.*.conversion_factor' => $request->rules()['item_units_of_measure.*.conversion_factor'],
            'item_units_of_measure.*.unit_of_measure' => $request->rules()['item_units_of_measure.*.unit_of_measure'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});
