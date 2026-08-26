<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Requests\BankLedgerTransactions\PartialUpdateBankLedgerTransactionRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated bank-ledger-transaction payload', function () {
    $payload = [
        'amount' => '75.25',
        'description' => 'Updated description',
    ];

    $request = PartialUpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PATCH',
        $payload,
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BankLedgerTransactionData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BankLedgerTransactionData::class)
        ->and($dto->id)->toBe('');
});

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a non-numeric amount', function () {
    $request = PartialUpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'NaN'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects a non-ISO-8601 date', function () {
    $request = PartialUpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => 'January 15, 2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
