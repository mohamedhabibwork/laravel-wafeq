<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\InvoiceLineItems\PartialUpdateInvoiceLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated invoice line item payload for PATCH', function () {
    $payload = [
        'account' => 'acc_1',
        'description' => 'Consulting hours',
        'quantity' => '2.5',
        'unit_amount' => '150.00',
    ];

    $request = PartialUpdateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/li_1/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(InvoiceLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(InvoiceLineItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a PATCH payload missing required fields', function () {
    $request = PartialUpdateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a non-integer order on PATCH', function () {
    $request = PartialUpdateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['order' => 'first'],
        ['order' => $request->rules()['order']],
    );

    expect($validator->fails())->toBeTrue();
});
