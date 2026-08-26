<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\SimplifiedInvoiceLineItems\PartialUpdateSimplifiedInvoiceLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated simplified-invoice line item payload for PATCH', function () {
    $payload = [
        'account' => 'acc_1',
        'description' => 'Service',
        'quantity' => '2.5',
        'unit_amount' => '150.00',
    ];

    $request = PartialUpdateSimplifiedInvoiceLineItemRequest::create('/simplified-invoices/sinv_1/line-items/li_1/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(SimplifiedInvoiceLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(SimplifiedInvoiceLineItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a PATCH payload missing required fields', function () {
    $request = PartialUpdateSimplifiedInvoiceLineItemRequest::create('/simplified-invoices/sinv_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a non-numeric unit_amount on PATCH', function () {
    $request = PartialUpdateSimplifiedInvoiceLineItemRequest::create('/simplified-invoices/sinv_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['unit_amount' => 'free'],
        ['unit_amount' => $request->rules()['unit_amount']],
    );

    expect($validator->fails())->toBeTrue();
});
