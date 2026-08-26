<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Requests\Employees\CreateEmployeeRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated employee payload', function () {
    $payload = [
        'name' => 'Sara Al-Saud',
        'email' => 'sara@example.com',
        'address' => '123 King Fahd Rd',
        'city' => 'Riyadh',
        'country' => 'SA',
        'date_hired' => '2026-01-15',
        'user' => 'user_abc',
    ];

    $request = CreateEmployeeRequest::create('/employees/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(EmployeeData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an employee payload missing the name', function () {
    $request = CreateEmployeeRequest::create('/employees/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an invalid email format', function () {
    $request = CreateEmployeeRequest::create('/employees/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['email' => 'not-an-email'],
        ['email' => $request->rules()['email']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects a malformed date_hired', function () {
    $request = CreateEmployeeRequest::create('/employees/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date_hired' => '15/01/2026'],
        ['date_hired' => $request->rules()['date_hired']],
    );

    expect($validator->fails())->toBeTrue();
});
