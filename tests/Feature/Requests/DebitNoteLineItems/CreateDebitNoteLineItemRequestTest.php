<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Requests\DebitNoteLineItems\CreateDebitNoteLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated debit note line item create payload', function () {
    $payload = [
        'account' => 'acc_1',
        'description' => 'Item A',
        'quantity' => '1.00',
        'unit_amount' => '100.00',
        'item' => 'item_1',
        'item_unit_of_measure' => 'uom_kg',
        'cost_center' => 'cc_ops',
        'tax_rate' => 'tax_vat',
        'discount' => '5.00',
        'order' => 1,
        'custom_fields' => ['cf_1' => 'value'],
    ];

    $request = CreateDebitNoteLineItemRequest::create('/debit-notes/dn_1/line-items/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(DebitNoteLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(DebitNoteLineItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a debit note line item payload missing required fields', function () {
    $request = CreateDebitNoteLineItemRequest::create('/debit-notes/dn_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('quantity'))->toBeTrue()
        ->and($validator->errors()->has('unit_amount'))->toBeTrue();
});

it('rejects a negative discount percentage', function () {
    $request = CreateDebitNoteLineItemRequest::create('/debit-notes/dn_1/line-items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['discount' => '-5'],
        ['discount' => $request->rules()['discount']],
    );

    expect($validator->fails())->toBeTrue();
});
