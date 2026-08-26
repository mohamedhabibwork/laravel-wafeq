<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\Payments\UpdatePaymentRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated payment update payload', function () {
    $payload = [
        'amount' => '750.00',
        'currency' => 'AED',
        'date' => '2026-04-01',
        'paid_through_account' => 'bank_2',
        'reference' => 'PAY-2026-002',
        'external_id' => 'ext-pay-2',
    ];

    $request = UpdatePaymentRequest::create('/payments/abc/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a payment update payload missing required fields', function () {
    $request = UpdatePaymentRequest::create('/payments/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue()
        ->and($validator->errors()->has('paid_through_account'))->toBeTrue();
});

it('rejects a non-numeric amount on the payment update payload', function () {
    $request = UpdatePaymentRequest::create('/payments/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'one hundred'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});
