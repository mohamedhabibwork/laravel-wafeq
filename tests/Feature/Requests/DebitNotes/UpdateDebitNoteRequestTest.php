<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\DebitNotes\UpdateDebitNoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated debit note update payload', function () {
    $payload = [
        'contact' => 'vendor_2',
        'currency' => 'AED',
        'debit_note_date' => '2026-04-01',
        'debit_note_number' => 'DN-2026-002',
        'line_items' => [
            ['account' => 'acc_2', 'description' => 'Item B', 'quantity' => '2.00', 'unit_amount' => '50.00'],
        ],
        'branch' => 'branch_main',
        'project' => 'proj_y',
        'exchange_rate' => '3.67',
        'notes' => 'Updated debit note',
        'external_id' => 'ext-dn-2',
        'order_number' => 'PO-002',
        'reference' => 'REF-DN-002',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'status' => 'POSTED',
        'attachments' => ['file_b'],
        'custom_fields' => ['cf_2' => 'value2'],
    ];

    $request = UpdateDebitNoteRequest::create('/debit-notes/abc/', 'PUT', $payload);
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
    expect($dto)->toBeInstanceOf(DebitNoteData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateDebitNoteRequest::create('/debit-notes/abc/', 'PUT', []);
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

it('rejects an invalid status value on update', function () {
    $request = UpdateDebitNoteRequest::create('/debit-notes/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'WHATEVER'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
