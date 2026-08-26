<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\Warehouses\UpdateWarehouseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated warehouse update payload', function () {
    $payload = [
        'account' => 'acc_warehouse_001',
        'address' => ['en' => 'New Address 1'],
        'building_number' => '9002',
        'city' => ['en' => 'Jeddah'],
        'code' => 'WH-001',
        'district' => ['en' => 'New District'],
        'name' => ['en' => 'Jeddah Warehouse'],
        'phone' => '+966126543210',
        'postal_code' => '21577',
    ];

    $request = UpdateWarehouseRequest::create('/warehouses/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(WarehouseData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateWarehouseRequest::create('/warehouses/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('address'))->toBeTrue()
        ->and($validator->errors()->has('code'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue()
        ->and($validator->errors()->has('phone'))->toBeTrue();
});
