<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\Warehouses\CreateWarehouseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated warehouse payload', function () {
    $payload = [
        'account' => 'acc_warehouse_001',
        'address' => ['en' => 'Industrial Area 5', 'ar' => 'المنطقة الصناعية الخامسة'],
        'building_number' => '9001',
        'city' => ['en' => 'Riyadh', 'ar' => 'الرياض'],
        'code' => 'WH-001',
        'district' => ['en' => 'Industrial Zone', 'ar' => 'المنطقة الصناعية'],
        'is_active' => true,
        'name' => ['en' => 'Riyadh Main Warehouse', 'ar' => 'المستودع الرئيسي - الرياض'],
        'phone' => '+966112345678',
        'postal_code' => '11564',
    ];

    $request = CreateWarehouseRequest::create('/warehouses/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(WarehouseData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a warehouse payload missing required fields', function () {
    $request = CreateWarehouseRequest::create('/warehouses/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('address'))->toBeTrue()
        ->and($validator->errors()->has('building_number'))->toBeTrue()
        ->and($validator->errors()->has('city'))->toBeTrue()
        ->and($validator->errors()->has('code'))->toBeTrue()
        ->and($validator->errors()->has('district'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue()
        ->and($validator->errors()->has('phone'))->toBeTrue()
        ->and($validator->errors()->has('postal_code'))->toBeTrue();
});

it('rejects a localised object missing the english text', function () {
    $request = CreateWarehouseRequest::create('/warehouses/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name' => ['ar' => 'فقط عربي']],
        [
            'name' => $request->rules()['name'],
            'name.en' => $request->rules()['name.en'],
            'name.ar' => $request->rules()['name.ar'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});
