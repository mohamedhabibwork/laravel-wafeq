<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Requests\Items\UpdateItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated item update payload', function () {
    $payload = [
        'name' => 'Office Chair v2',
        'sku' => 'CHAIR-002',
        'unit_price' => 219.99,
    ];

    $request = UpdateItemRequest::create('/items/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ItemData::class);
});

it('rejects an update payload missing the name', function () {
    $request = UpdateItemRequest::create('/items/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects a non-numeric unit_price', function () {
    $request = UpdateItemRequest::create('/items/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['unit_price' => 'free'],
        ['unit_price' => $request->rules()['unit_price']],
    );

    expect($validator->fails())->toBeTrue();
});
