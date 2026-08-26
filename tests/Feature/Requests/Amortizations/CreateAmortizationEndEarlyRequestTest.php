<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Requests\Amortizations\CreateAmortizationEndEarlyRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated amortization end-early payload', function () {
    $payload = [
        'amount' => '2500.00',
        'end_early_account' => 'acc_1',
        'end_early_date' => '2026-07-01',
        'notes' => 'Terminated due to contract cancellation.',
    ];

    $request = CreateAmortizationEndEarlyRequest::create('/amortizations/abc/end-early/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(AmortizationData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an amortization end-early payload missing required fields', function () {
    $request = CreateAmortizationEndEarlyRequest::create('/amortizations/abc/end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('end_early_account'))->toBeTrue()
        ->and($validator->errors()->has('end_early_date'))->toBeTrue()
        ->and($validator->errors()->has('notes'))->toBeTrue();
});

it('rejects a malformed end_early_date', function () {
    $request = CreateAmortizationEndEarlyRequest::create('/amortizations/abc/end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['end_early_date' => '2026/07/01'],
        ['end_early_date' => $request->rules()['end_early_date']],
    );

    expect($validator->fails())->toBeTrue();
});
