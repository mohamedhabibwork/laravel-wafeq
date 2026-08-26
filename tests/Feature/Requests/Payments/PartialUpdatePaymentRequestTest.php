<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\Payments\PartialUpdatePaymentRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['reference' => 'PAY-2026-PATCH'];

    $request = PartialUpdatePaymentRequest::create('/payments/abc/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PaymentData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payment payload as valid', function () {
    $request = PartialUpdatePaymentRequest::create('/payments/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a malformed date on the partial-update payment payload', function () {
    $request = PartialUpdatePaymentRequest::create('/payments/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => '01-04-2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id on the partial-update payment payload', function () {
    $request = PartialUpdatePaymentRequest::create('/payments/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('x', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
