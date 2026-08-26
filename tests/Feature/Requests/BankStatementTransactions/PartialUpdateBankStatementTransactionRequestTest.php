<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Requests\BankStatementTransactions\PartialUpdateBankStatementTransactionRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated bank-statement-transaction payload', function () {
    $payload = [
        'description' => 'Updated description',
        'statement_balance' => '13000.00',
    ];

    $request = PartialUpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PATCH',
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

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a non-numeric amount', function () {
    $request = PartialUpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'twelve'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects a non-ISO-8601 date', function () {
    $request = PartialUpdateBankStatementTransactionRequest::create(
        '/bank-accounts/ba_1/statement-transactions/st_1/',
        'PATCH',
        [],
    );
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => '15-01-2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
