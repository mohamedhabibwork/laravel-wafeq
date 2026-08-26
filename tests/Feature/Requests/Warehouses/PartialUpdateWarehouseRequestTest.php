<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\Warehouses\PartialUpdateWarehouseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateWarehouseRequest::create('/warehouses/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(WarehouseData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'is_active' => false,
        'phone' => '+966112345678',
    ];

    $request = PartialUpdateWarehouseRequest::create('/warehouses/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(WarehouseData::class);
});

it('rejects a localised object provided without the english key', function () {
    $request = PartialUpdateWarehouseRequest::create('/warehouses/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['city' => ['ar' => 'بدون إنجليزي']],
        [
            'city' => $request->rules()['city'],
            'city.en' => $request->rules()['city.en'],
            'city.ar' => $request->rules()['city.ar'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});
