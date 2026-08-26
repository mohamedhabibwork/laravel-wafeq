<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Requests\Employees\UpdateEmployeeRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated employee update payload', function () {
    $payload = [
        'name' => 'Sara Al-Saud',
        'email' => 'sara@example.com',
        'address' => '456 Olaya St',
        'city' => 'Jeddah',
        'country' => 'SA',
    ];

    $request = UpdateEmployeeRequest::create('/employees/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(EmployeeData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(EmployeeData::class);
});

it('rejects an update payload missing the name', function () {
    $request = UpdateEmployeeRequest::create('/employees/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an invalid email format', function () {
    $request = UpdateEmployeeRequest::create('/employees/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['email' => 'nope'],
        ['email' => $request->rules()['email']],
    );

    expect($validator->fails())->toBeTrue();
});
