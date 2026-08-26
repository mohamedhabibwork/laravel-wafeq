<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\DebitNotes\CreateDebitNoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated debit note create payload', function () {
    $payload = [
        'contact' => 'vendor_1',
        'currency' => 'SAR',
        'debit_note_date' => '2026-03-01',
        'debit_note_number' => 'DN-2026-001',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Item A', 'quantity' => '1.00', 'unit_amount' => '100.00'],
        ],
        'branch' => 'branch_main',
        'project' => 'proj_x',
        'exchange_rate' => '3.75',
        'notes' => 'Monthly debit note',
        'external_id' => 'ext-dn-1',
        'order_number' => 'PO-001',
        'reference' => 'REF-DN-001',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'status' => 'DRAFT',
        'attachments' => ['file_a'],
        'custom_fields' => ['cf_1' => 'value'],
    ];

    $request = CreateDebitNoteRequest::create('/debit-notes/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(DebitNoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(DebitNoteData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a debit note payload missing required fields', function () {
    $request = CreateDebitNoteRequest::create('/debit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('debit_note_date'))->toBeTrue()
        ->and($validator->errors()->has('debit_note_number'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid status value', function () {
    $request = CreateDebitNoteRequest::create('/debit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long order_number', function () {
    $request = CreateDebitNoteRequest::create('/debit-notes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['order_number' => str_repeat('a', 101)],
        ['order_number' => $request->rules()['order_number']],
    );

    expect($validator->fails())->toBeTrue();
});
