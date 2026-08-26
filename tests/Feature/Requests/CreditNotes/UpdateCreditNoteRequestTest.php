<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\CreditNotes\UpdateCreditNoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated credit note update payload', function () {
    $payload = [
        'contact' => 'customer_2',
        'credit_note_date' => '2026-04-01',
        'credit_note_number' => 'CN-2026-002',
        'currency' => 'AED',
        'line_items' => [
            ['account' => 'acc_2', 'description' => 'Item B', 'quantity' => '2.00', 'unit_amount' => '50.00'],
        ],
        'branch' => 'branch_main',
        'project' => 'proj_y',
        'exchange_rate' => '3.67',
        'notes' => 'Updated credit note',
        'external_id' => 'ext-cn-2',
        'reference' => 'REF-CN-002',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'language' => 'ar',
        'status' => 'SENT',
        'attachments' => ['file_b'],
        'custom_fields' => ['cf_2' => 'value2'],
        'discount_cost_center' => 'cc_other',
        'place_of_supply' => 'Dubai',
        'warehouse' => 'wh_branch',
    ];

    $request = UpdateCreditNoteRequest::create('/credit-notes/abc/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CreditNoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CreditNoteData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateCreditNoteRequest::create('/credit-notes/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('credit_note_date'))->toBeTrue()
        ->and($validator->errors()->has('credit_note_number'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid status value on update', function () {
    $request = UpdateCreditNoteRequest::create('/credit-notes/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'WHATEVER'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
