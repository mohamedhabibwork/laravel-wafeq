<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\PaymentRequests\UpdatePaymentRequestRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated payment-request update payload', function () {
    $payload = [
        'amount' => '2000.00',
        'bank_account' => 'bank_1',
        'beneficiary' => 'ben_1',
        'charge_type' => 'BEN',
        'contact' => 'cust_1',
        'currency' => 'SAR',
        'details_of_payment' => 'Updated payment details',
        'reference' => 'PR-2026-002',
        'send_payment_advice' => false,
    ];

    $request = UpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentRequestData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a payment-request update payload missing required fields', function () {
    $request = UpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('bank_account'))->toBeTrue()
        ->and($validator->errors()->has('beneficiary'))->toBeTrue()
        ->and($validator->errors()->has('charge_type'))->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('details_of_payment'))->toBeTrue()
        ->and($validator->errors()->has('reference'))->toBeTrue()
        ->and($validator->errors()->has('send_payment_advice'))->toBeTrue();
});

it('rejects an invalid charge_type on the payment-request update payload', function () {
    $request = UpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['charge_type' => 'WHO'],
        ['charge_type' => $request->rules()['charge_type']],
    );

    expect($validator->fails())->toBeTrue();
});
