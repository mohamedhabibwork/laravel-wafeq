<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Requests\Quotes\CreateQuoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated quote payload', function () {
    $payload = [
        'attachments' => ['file_a'],
        'branch' => 'branch_main',
        'contact' => 'contact_1',
        'currency' => 'SAR',
        'custom_fields' => ['fld_1' => 'value'],
        'discount_account' => 'acc_d',
        'discount_amount' => '5.00',
        'discount_cost_center' => 'cc_d',
        'discount_tax_rate' => 'tax_d',
        'exchange_rate' => '3.75',
        'external_id' => 'ext-1',
        'language' => 'en',
        'line_items' => [
            ['description' => 'Service', 'quantity' => '1.0', 'unit_amount' => '100.00'],
        ],
        'notes' => 'thanks',
        'project' => 'proj_x',
        'purchase_order' => 'PO-1',
        'quote_date' => '2026-01-15',
        'quote_number' => 'Q-2026-001',
        'reference' => 'REF-1',
        'status' => 'DRAFT',
        'tax_amount_type' => 'TAX_INCLUSIVE',
    ];

    $request = CreateQuoteRequest::create('/quotes/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(QuoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(QuoteData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a quote payload missing required fields', function () {
    $request = CreateQuoteRequest::create('/quotes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue()
        ->and($validator->errors()->has('quote_date'))->toBeTrue()
        ->and($validator->errors()->has('quote_number'))->toBeTrue();
});

it('rejects an invalid status value', function () {
    $request = CreateQuoteRequest::create('/quotes/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
