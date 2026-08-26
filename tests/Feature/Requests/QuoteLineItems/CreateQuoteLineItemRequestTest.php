<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Requests\QuoteLineItems\CreateQuoteLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated quote line item payload', function () {
    $payload = [
        'cost_center' => 'cc_ops',
        'custom_fields' => ['fld_1' => 'value'],
        'description' => 'Service',
        'discount' => '10.0',
        'item' => 'item_svc',
        'item_unit_of_measure' => 'uom_hr',
        'order' => 1,
        'quantity' => '2.5',
        'tax_rate' => 'tax_std',
        'unit_amount' => '150.00',
    ];

    $request = CreateQuoteLineItemRequest::create('/quotes/q_1/line-items/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(QuoteLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(QuoteLineItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a payload missing required fields', function () {
    $request = CreateQuoteLineItemRequest::create('/quotes/q_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a non-numeric quantity', function () {
    $request = CreateQuoteLineItemRequest::create('/quotes/q_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['quantity' => 'lots'],
        ['quantity' => $request->rules()['quantity']],
    );

    expect($validator->fails())->toBeTrue();
});
