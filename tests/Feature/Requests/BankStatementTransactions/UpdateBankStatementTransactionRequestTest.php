<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Requests\BankStatementTransactions\UpdateBankStatementTransactionRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated bank-statement-transaction payload', function () {
    $payload = [
        'amount' => '250.00',
        'bank_reference' => 'BANK-TXN-001',
        'cost_center' => 'cc_ops',
        'date' => '2026-01-15',
        'description' => 'Wire transfer in',
        'project' => 'proj_x',
        'reference' => 'STMT-2026-001',
        'statement_balance' => '12500.00',
    ];

    $request = UpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PUT',
        $payload,
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BankStatementTransactionData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BankStatementTransactionData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a bank-statement-transaction payload missing required fields', function () {
    $request = UpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue()
        ->and($validator->errors()->has('statement_balance'))->toBeTrue();
});

it('rejects a non-numeric statement_balance', function () {
    $request = UpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['statement_balance' => 'unknown'],
        ['statement_balance' => $request->rules()['statement_balance']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an empty date', function () {
    $request = UpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PUT',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => ''],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
