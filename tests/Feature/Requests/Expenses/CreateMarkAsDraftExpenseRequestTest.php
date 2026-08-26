<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Requests\Expenses\CreateMarkAsDraftExpenseRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty body for the mark-as-draft endpoint', function () {
    $request = CreateMarkAsDraftExpenseRequest::create('/expenses/abc/mark-as-draft/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()->toBe([])
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ExpenseData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('returns an ExpenseData DTO for the mark-as-draft endpoint', function () {
    $request = CreateMarkAsDraftExpenseRequest::create('/expenses/abc/mark-as-draft/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));
    $request->merge([]);
    $request->validateResolved();

    expect($request->toDto())->toBeInstanceOf(ExpenseData::class);
});
