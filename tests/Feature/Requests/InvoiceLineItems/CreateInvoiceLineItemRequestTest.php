<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\InvoiceLineItems\CreateInvoiceLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated invoice line item payload', function () {
    $payload = [
        'account' => 'acc_1',
        'cost_center' => 'cc_ops',
        'custom_fields' => ['fld_1' => 'value'],
        'description' => 'Consulting hours',
        'discount' => '10.0',
        'item' => 'item_svc',
        'item_unit_of_measure' => 'uom_hr',
        'order' => 1,
        'quantity' => '2.5',
        'tax_rate' => 'tax_std',
        'unit_amount' => '150.00',
    ];

    $request = CreateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/', 'POST', $payload);
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

it('rejects an invoice line item payload missing required fields', function () {
    $request = CreateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a non-numeric quantity', function () {
    $request = CreateInvoiceLineItemRequest::create('/invoices/inv_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['quantity' => 'not-a-number'],
        ['quantity' => $request->rules()['quantity']],
    );

    expect($validator->fails())->toBeTrue();
});
