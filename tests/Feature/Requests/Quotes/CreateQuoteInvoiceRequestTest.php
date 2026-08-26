<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Requests\Quotes\CreateQuoteInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('exposes no validation rules for the convert-quote-to-invoice endpoint', function () {
    $request = CreateQuoteInvoiceRequest::create('/quotes/q_1/invoice/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()->toBeEmpty()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(QuoteData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('materialises a QuoteData from a minimal payload', function () {
    $payload = ['id' => 'q_1'];

    $request = CreateQuoteInvoiceRequest::create('/quotes/q_1/invoice/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(QuoteData::class);
});

it('rejects no fields because there is no body', function () {
    $request = CreateQuoteInvoiceRequest::create('/quotes/q_1/invoice/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(['any_field' => 'any_value'], $request->rules());
    expect($validator->fails())->toBeFalse();
});
