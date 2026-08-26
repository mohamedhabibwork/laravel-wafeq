<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\Expenses\UpdateExpenseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated expense update payload', function () {
    $payload = [
        'account' => 'acc_1',
        'amount' => '150.00',
        'currency' => 'SAR',
        'date' => '2026-02-01',
        'description' => 'Updated office supplies',
        'paid_through_account' => 'bank_1',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'reference' => 'EXP-2026-002',
        'external_id' => 'ext-2',
        'attachments' => ['file_c'],
        'branch' => 'branch_main',
        'cost_center' => 'cc_ops',
        'project' => 'proj_y',
    ];

    $request = UpdateExpenseRequest::create('/expenses/abc/', 'PUT', $payload);
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
    expect($dto)->toBeInstanceOf(ExpenseData::class);
});

it('rejects an expense update payload missing required fields', function () {
    $request = UpdateExpenseRequest::create('/expenses/abc/', 'PUT', []);
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

it('rejects an invalid tax_amount_type value on update', function () {
    $request = UpdateExpenseRequest::create('/expenses/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'WHATEVER'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
