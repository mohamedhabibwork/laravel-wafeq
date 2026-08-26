<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Requests\QuoteLineItems\PartialUpdateQuoteLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated quote line item payload for PATCH', function () {
    $payload = [
        'description' => 'Service',
        'quantity' => '2.5',
        'unit_amount' => '150.00',
    ];

    $request = PartialUpdateQuoteLineItemRequest::create('/quotes/q_1/line-items/li_1/', 'PATCH', $payload);
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

it('rejects a PATCH payload missing required fields', function () {
    $request = PartialUpdateQuoteLineItemRequest::create('/quotes/q_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a non-integer order on PATCH', function () {
    $request = PartialUpdateQuoteLineItemRequest::create('/quotes/q_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['order' => 'first'],
        ['order' => $request->rules()['order']],
    );

    expect($validator->fails())->toBeTrue();
});
