<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Requests\Accounts\CreateAccountRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated account payload', function () {
    $payload = [
        'account_code' => '1000',
        'account_type' => 'BANK',
        'classification' => 'ASSET',
        'external_id' => 'ext-1',
        'is_payment_enabled' => true,
        'is_posting' => true,
        'name_ar' => 'حساب بنك',
        'name_en' => 'Bank Account',
        'parent' => 'acc_root',
        'sub_classification' => 'CURRENT_ASSET',
    ];

    $request = CreateAccountRequest::create('/accounts/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(AccountData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(AccountData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an account payload missing required fields', function () {
    $request = CreateAccountRequest::create('/accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('classification'))->toBeTrue()
        ->and($validator->errors()->has('name_en'))->toBeTrue()
        ->and($validator->errors()->has('sub_classification'))->toBeTrue();
});

it('rejects an invalid classification value', function () {
    $request = CreateAccountRequest::create('/accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['classification' => 'NOPE'],
        ['classification' => $request->rules()['classification']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long account_code', function () {
    $request = CreateAccountRequest::create('/accounts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['account_code' => str_repeat('a', 31)],
        ['account_code' => $request->rules()['account_code']],
    );

    expect($validator->fails())->toBeTrue();
});
