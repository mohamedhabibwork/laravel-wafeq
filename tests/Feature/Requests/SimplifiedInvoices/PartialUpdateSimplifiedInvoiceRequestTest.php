<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Requests\SimplifiedInvoices\PartialUpdateSimplifiedInvoiceRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated simplified-invoice payload for PATCH', function () {
    $payload = [
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'invoice_date' => '2026-01-15',
        'invoice_number' => 'SINV-2026-001',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'paid_through_account' => 'bank_1',
    ];

    $request = PartialUpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PATCH', $payload);
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

it('rejects a PATCH payload missing required fields', function () {
    $request = PartialUpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PATCH', []);
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

it('rejects an invalid language value on PATCH', function () {
    $request = PartialUpdateSimplifiedInvoiceRequest::create('/simplified-invoices/sinv_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['language' => 'fr'],
        ['language' => $request->rules()['language']],
    );

    expect($validator->fails())->toBeTrue();
});
