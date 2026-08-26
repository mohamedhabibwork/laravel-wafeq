<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Requests\Invoices\UpdateInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated invoice payload for PUT', function () {
    $payload = [
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'invoice_date' => '2026-01-15',
        'invoice_due_date' => '2026-02-15',
        'invoice_number' => 'INV-2026-001',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'status' => 'SENT',
    ];

    $request = UpdateInvoiceRequest::create('/invoices/inv_1/', 'PUT', $payload);
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

it('rejects an invoice payload missing required fields on PUT', function () {
    $request = UpdateInvoiceRequest::create('/invoices/inv_1/', 'PUT', []);
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

it('rejects an invalid status value on PUT', function () {
    $request = UpdateInvoiceRequest::create('/invoices/inv_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
