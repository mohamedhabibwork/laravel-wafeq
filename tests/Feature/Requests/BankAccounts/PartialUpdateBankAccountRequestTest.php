<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Requests\BankAccounts\PartialUpdateBankAccountRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated bank-account payload', function () {
    $payload = [
        'name' => 'Renamed Bank Account',
    ];

    $request = PartialUpdateBankAccountRequest::create('/bank-accounts/ba_1/', 'PATCH', $payload);
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

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdateBankAccountRequest::create('/bank-accounts/ba_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid sub_classification value', function () {
    $request = PartialUpdateBankAccountRequest::create('/bank-accounts/ba_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['sub_classification' => 'NOPE'],
        ['sub_classification' => $request->rules()['sub_classification']],
    );

    expect($validator->fails())->toBeTrue();
});

it('accepts a CREDIT_CARD sub_classification', function () {
    $request = PartialUpdateBankAccountRequest::create('/bank-accounts/ba_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['sub_classification' => 'CREDIT_CARD'],
        ['sub_classification' => $request->rules()['sub_classification']],
    );

    expect($validator->fails())->toBeFalse();
});
