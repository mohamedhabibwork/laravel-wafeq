<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\Expenses\CreateExpenseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated expense payload', function () {
    $payload = [
        'account' => 'acc_1',
        'amount' => '100.00',
        'currency' => 'SAR',
        'date' => '2026-01-15',
        'description' => 'Office supplies',
        'paid_through_account' => 'bank_1',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'reference' => 'EXP-2026-001',
        'external_id' => 'ext-1',
        'attachments' => ['file_a', 'file_b'],
        'branch' => 'branch_main',
        'cost_center' => 'cc_ops',
        'project' => 'proj_x',
    ];

    $request = CreateExpenseRequest::create('/expenses/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ExpenseData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ExpenseData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an expense payload missing required fields', function () {
    $request = CreateExpenseRequest::create('/expenses/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('paid_through_account'))->toBeTrue();
});

it('rejects an invalid tax_amount_type value', function () {
    $request = CreateExpenseRequest::create('/expenses/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'NOPE'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreateExpenseRequest::create('/expenses/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
