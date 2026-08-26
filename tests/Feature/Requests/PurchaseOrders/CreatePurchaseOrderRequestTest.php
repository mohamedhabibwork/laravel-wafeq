<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\PurchaseOrders\CreatePurchaseOrderRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated purchase order create payload', function () {
    $payload = [
        'currency' => 'SAR',
        'line_items' => [
            ['description' => 'Item A', 'quantity' => '1.00', 'unit_amount' => '100.00'],
        ],
        'contact' => 'vendor_1',
        'branch' => 'branch_main',
        'project' => 'proj_x',
        'exchange_rate' => '3.75',
        'notes' => 'Monthly PO',
        'external_id' => 'ext-po-1',
        'purchase_order_date' => '2026-03-01',
        'purchase_order_number' => 'PO-2026-001',
        'reference' => 'REF-PO-001',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'language' => 'en',
        'status' => 'DRAFT',
        'attachments' => ['file_a', 'file_b'],
        'custom_fields' => ['cf_1' => 'value'],
        'terms' => 'Net 30',
    ];

    $request = CreatePurchaseOrderRequest::create('/purchase-orders/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PurchaseOrderData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(PurchaseOrderData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a purchase order payload missing required fields', function () {
    $request = CreatePurchaseOrderRequest::create('/purchase-orders/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid status value', function () {
    $request = CreatePurchaseOrderRequest::create('/purchase-orders/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an invalid purchase_order_date format', function () {
    $request = CreatePurchaseOrderRequest::create('/purchase-orders/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['purchase_order_date' => '01-03-2026'],
        ['purchase_order_date' => $request->rules()['purchase_order_date']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreatePurchaseOrderRequest::create('/purchase-orders/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
