<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\PaymentRequests\PartialUpdatePaymentRequestRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['details_of_payment' => 'Updated only the description'];

    $request = PartialUpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentRequestData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payment-request payload as valid', function () {
    $request = PartialUpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid charge_type on the partial-update payment-request payload', function () {
    $request = PartialUpdatePaymentRequestRequest::create('/payment-requests/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['charge_type' => 'NOPE'],
        ['charge_type' => $request->rules()['charge_type']],
    );

    expect($validator->fails())->toBeTrue();
});
