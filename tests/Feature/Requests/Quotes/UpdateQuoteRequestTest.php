<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Requests\Quotes\UpdateQuoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated quote payload for PUT', function () {
    $payload = [
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'line_items' => [
            ['description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'quote_date' => '2026-01-15',
        'quote_number' => 'Q-2026-001',
        'status' => 'SENT',
        'tax_amount_type' => 'TAX_INCLUSIVE',
    ];

    $request = UpdateQuoteRequest::create('/quotes/q_1/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(QuoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(QuoteData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a PUT payload missing required fields', function () {
    $request = UpdateQuoteRequest::create('/quotes/q_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue()
        ->and($validator->errors()->has('quote_date'))->toBeTrue()
        ->and($validator->errors()->has('quote_number'))->toBeTrue();
});

it('rejects an invalid tax_amount_type value on PUT', function () {
    $request = UpdateQuoteRequest::create('/quotes/q_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'NOPE'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
