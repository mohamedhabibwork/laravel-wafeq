<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Requests\BankLedgerTransactions\UpdateBankLedgerTransactionRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated bank-ledger-transaction payload', function () {
    $payload = [
        'account' => 'acc_1',
        'amount' => '150.50',
        'contact' => 'contact_1',
        'date' => '2026-01-15',
        'description' => 'POS settlement',
        'project' => 'proj_x',
        'reference' => 'TX-2026-001',
        'tax_rate' => 'tax_vat15',
    ];

    $request = UpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PUT',
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

it('rejects a bank-ledger-transaction payload missing required fields', function () {
    $request = UpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue();
});

it('rejects a non-numeric amount', function () {
    $request = UpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'not-a-number'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an empty account', function () {
    $request = UpdateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/lt_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['account' => ''],
        ['account' => $request->rules()['account']],
    );

    expect($validator->fails())->toBeTrue();
});
