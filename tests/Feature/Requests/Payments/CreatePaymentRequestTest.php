<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\Payments\CreatePaymentRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated payment payload', function () {
    $payload = [
        'amount' => '500.00',
        'currency' => 'SAR',
        'date' => '2026-03-15',
        'paid_through_account' => 'bank_1',
        'contact' => 'cust_1',
        'cost_center' => 'cc_ops',
        'reference' => 'PAY-2026-001',
        'external_id' => 'ext-pay-1',
        'exchange_rate' => '1.0',
        'invoice_payments' => [
            ['invoice' => 'inv_1', 'amount' => '500.00', 'amount_to_pcy' => '500.00'],
        ],
    ];

    $request = CreatePaymentRequest::create('/payments/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a payment payload missing required fields', function () {
    $request = CreatePaymentRequest::create('/payments/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue()
        ->and($validator->errors()->has('paid_through_account'))->toBeTrue();
});

it('rejects a malformed date on the payment payload', function () {
    $request = CreatePaymentRequest::create('/payments/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => '15/03/2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
