<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Requests\CreditNoteLineItems\UpdateCreditNoteLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated credit note line item update payload', function () {
    $payload = [
        'account' => 'acc_2',
        'description' => 'Item B',
        'quantity' => '3.00',
        'unit_amount' => '75.50',
        'item' => 'item_2',
        'cost_center' => 'cc_finance',
        'tax_rate' => 'tax_zero',
        'discount' => '10.00',
        'order' => 2,
        'custom_fields' => ['cf_x' => 'y'],
    ];

    $request = UpdateCreditNoteLineItemRequest::create('/credit-notes/cn_1/line-items/li_1/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CreditNoteLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CreditNoteLineItemData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateCreditNoteLineItemRequest::create('/credit-notes/cn_1/line-items/li_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});
