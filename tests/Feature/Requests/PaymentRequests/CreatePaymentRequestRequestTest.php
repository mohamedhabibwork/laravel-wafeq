<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\PaymentRequests\CreatePaymentRequestRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated payment-request payload', function () {
    $payload = [
        'amount' => '1000.00',
        'bank_account' => 'bank_1',
        'beneficiary' => 'ben_1',
        'charge_type' => 'OUR',
        'contact' => 'cust_1',
        'currency' => 'SAR',
        'details_of_payment' => 'Q1 invoice settlement',
        'reference' => 'PR-2026-001',
        'send_payment_advice' => true,
        'cost_center' => 'cc_ops',
        'attachments' => ['file_a'],
        'bills' => ['bill_1'],
    ];

    $request = CreatePaymentRequestRequest::create('/payment-requests/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentRequestData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a payment-request payload missing required fields', function () {
    $request = CreatePaymentRequestRequest::create('/payment-requests/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('bank_account'))->toBeTrue()
        ->and($validator->errors()->has('beneficiary'))->toBeTrue()
        ->and($validator->errors()->has('charge_type'))->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('details_of_payment'))->toBeTrue()
        ->and($validator->errors()->has('reference'))->toBeTrue()
        ->and($validator->errors()->has('send_payment_advice'))->toBeTrue();
});

it('rejects an invalid charge_type value', function () {
    $request = CreatePaymentRequestRequest::create('/payment-requests/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['charge_type' => 'INVALID'],
        ['charge_type' => $request->rules()['charge_type']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long details_of_payment value', function () {
    $request = CreatePaymentRequestRequest::create('/payment-requests/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['details_of_payment' => str_repeat('a', 201)],
        ['details_of_payment' => $request->rules()['details_of_payment']],
    );

    expect($validator->fails())->toBeTrue();
});
