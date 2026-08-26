<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Requests\Accounts\UpdateAccountRequest;
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

    $request = UpdateAccountRequest::create('/accounts/acc_1/', 'PUT', $payload);
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
    $request = UpdateAccountRequest::create('/accounts/acc_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('classification'))->toBeTrue()
        ->and($validator->errors()->has('name_en'))->toBeTrue()
        ->and($validator->errors()->has('sub_classification'))->toBeTrue();
});

it('rejects an invalid sub_classification value', function () {
    $request = UpdateAccountRequest::create('/accounts/acc_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['sub_classification' => 'NOPE'],
        ['sub_classification' => $request->rules()['sub_classification']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long name_ar', function () {
    $request = UpdateAccountRequest::create('/accounts/acc_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name_ar' => str_repeat('a', 201)],
        ['name_ar' => $request->rules()['name_ar']],
    );

    expect($validator->fails())->toBeTrue();
});
