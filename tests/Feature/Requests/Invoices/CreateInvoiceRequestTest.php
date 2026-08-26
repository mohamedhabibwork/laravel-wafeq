<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Requests\Invoices\CreateInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated invoice payload', function () {
    $payload = [
        'attachments' => ['file_a', 'file_b'],
        'branch' => 'branch_main',
        'contact' => 'contact_1',
        'credit_notes' => [['credit_note' => 'cn_1', 'amount' => '10.00']],
        'currency' => 'SAR',
        'custom_fields' => ['fld_1' => 'value'],
        'discount_account' => 'acc_d',
        'discount_amount' => '5.00',
        'discount_cost_center' => 'cc_d',
        'discount_tax_rate' => 'tax_d',
        'exchange_rate' => '3.75',
        'external_id' => 'ext-1',
        'invoice_date' => '2026-01-15',
        'invoice_due_date' => '2026-02-15',
        'invoice_number' => 'INV-2026-001',
        'language' => 'en',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'notes' => 'Thanks',
        'place_of_supply' => 'DUBAI',
        'project' => 'proj_x',
        'purchase_order' => 'PO-1',
        'reference' => 'REF-1',
        'status' => 'DRAFT',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'warehouse' => 'wh_1',
    ];

    $request = CreateInvoiceRequest::create('/invoices/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(InvoiceData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(InvoiceData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an invoice payload missing required fields', function () {
    $request = CreateInvoiceRequest::create('/invoices/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('invoice_date'))->toBeTrue()
        ->and($validator->errors()->has('invoice_due_date'))->toBeTrue()
        ->and($validator->errors()->has('invoice_number'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid tax_amount_type value', function () {
    $request = CreateInvoiceRequest::create('/invoices/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'NOPE'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
