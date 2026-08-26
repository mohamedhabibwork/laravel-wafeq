<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Requests\BankLedgerTransactions\CreateBankLedgerTransactionRequest;
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

    $request = CreateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/',
        'POST',
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
    $request = CreateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/',
        'POST',
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
    $request = CreateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/',
        'POST',
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

it('rejects a non-ISO-8601 date', function () {
    $request = CreateBankLedgerTransactionRequest::create(
        '/bank-accounts/ba_1/ledger-transactions/',
        'POST',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => '15/01/2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
