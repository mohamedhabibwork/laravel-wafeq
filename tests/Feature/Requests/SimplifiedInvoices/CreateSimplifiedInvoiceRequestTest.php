<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Requests\SimplifiedInvoices\CreateSimplifiedInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated simplified-invoice payload', function () {
    $payload = [
        'branch' => 'branch_main',
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'exchange_rate' => '3.75',
        'external_id' => 'ext-1',
        'invoice_date' => '2026-01-15',
        'invoice_number' => 'SINV-2026-001',
        'language' => 'en',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'notes' => 'thanks',
        'paid_through_account' => 'bank_1',
        'place_of_supply' => 'DUBAI',
        'project' => 'proj_x',
        'reference' => 'REF-1',
        'status' => 'DRAFT',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'warehouse' => 'wh_1',
    ];

    $request = CreateSimplifiedInvoiceRequest::create('/simplified-invoices/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(SimplifiedInvoiceData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(SimplifiedInvoiceData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a simplified-invoice payload missing required fields', function () {
    $request = CreateSimplifiedInvoiceRequest::create('/simplified-invoices/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('invoice_date'))->toBeTrue()
        ->and($validator->errors()->has('invoice_number'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue()
        ->and($validator->errors()->has('paid_through_account'))->toBeTrue();
});

it('rejects an invalid status value', function () {
    $request = CreateSimplifiedInvoiceRequest::create('/simplified-invoices/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
