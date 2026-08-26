<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Requests\SimplifiedInvoices\UpdateSimplifiedInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated simplified-invoice payload for PUT', function () {
    $payload = [
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'invoice_date' => '2026-01-15',
        'invoice_number' => 'SINV-2026-001',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'paid_through_account' => 'bank_1',
        'tax_amount_type' => 'TAX_INCLUSIVE',
    ];

    $request = UpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PUT', $payload);
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

it('rejects a PUT payload missing required fields', function () {
    $request = UpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PUT', []);
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

it('rejects an invalid tax_amount_type value on PUT', function () {
    $request = UpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'NOPE'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
