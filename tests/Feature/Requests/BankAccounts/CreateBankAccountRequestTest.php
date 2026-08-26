<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Requests\BankAccounts\CreateBankAccountRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated bank-account payload', function () {
    $payload = [
        'currency' => 'SAR',
        'name' => 'Al Rajhi Operating Account',
        'sub_classification' => 'BANK',
    ];

    $request = CreateBankAccountRequest::create('/bank-accounts/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BankAccountData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BankAccountData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a bank-account payload missing required fields', function () {
    $request = CreateBankAccountRequest::create('/bank-accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue()
        ->and($validator->errors()->has('sub_classification'))->toBeTrue();
});

it('rejects an invalid sub_classification value', function () {
    $request = CreateBankAccountRequest::create('/bank-accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['sub_classification' => 'NOPE'],
        ['sub_classification' => $request->rules()['sub_classification']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an empty currency', function () {
    $request = CreateBankAccountRequest::create('/bank-accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['currency' => ''],
        ['currency' => $request->rules()['currency']],
    );

    expect($validator->fails())->toBeTrue();
});
