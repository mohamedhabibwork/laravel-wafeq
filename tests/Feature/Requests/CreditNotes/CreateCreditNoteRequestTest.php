<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\CreditNotes\CreateCreditNoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated credit note create payload', function () {
    $payload = [
        'contact' => 'customer_1',
        'credit_note_date' => '2026-03-01',
        'credit_note_number' => 'CN-2026-001',
        'currency' => 'SAR',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Item A', 'quantity' => '1.00', 'unit_amount' => '100.00'],
        ],
        'branch' => 'branch_main',
        'project' => 'proj_x',
        'exchange_rate' => '3.75',
        'notes' => 'Monthly credit note',
        'external_id' => 'ext-cn-1',
        'reference' => 'REF-CN-001',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'language' => 'en',
        'status' => 'DRAFT',
        'attachments' => ['file_a'],
        'custom_fields' => ['cf_1' => 'value'],
        'discount_cost_center' => 'cc_discount',
        'place_of_supply' => 'Riyadh',
        'warehouse' => 'wh_main',
    ];

    $request = CreateCreditNoteRequest::create('/credit-notes/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(CreditNoteData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a credit note payload missing required fields', function () {
    $request = CreateCreditNoteRequest::create('/credit-notes/', 'POST', []);
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

it('rejects an invalid status value', function () {
    $request = CreateCreditNoteRequest::create('/credit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an invalid language value', function () {
    $request = CreateCreditNoteRequest::create('/credit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['language' => 'fr'],
        ['language' => $request->rules()['language']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreateCreditNoteRequest::create('/credit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
