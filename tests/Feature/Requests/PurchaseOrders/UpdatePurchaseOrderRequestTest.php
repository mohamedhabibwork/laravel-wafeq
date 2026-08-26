<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\PurchaseOrders\UpdatePurchaseOrderRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated purchase order update payload', function () {
    $payload = [
        'currency' => 'AED',
        'line_items' => [
            ['description' => 'Item B', 'quantity' => '2.00', 'unit_amount' => '50.00'],
        ],
        'contact' => 'vendor_2',
        'branch' => 'branch_main',
        'project' => 'proj_y',
        'exchange_rate' => '3.67',
        'notes' => 'Updated PO',
        'external_id' => 'ext-po-2',
        'purchase_order_date' => '2026-04-01',
        'purchase_order_number' => 'PO-2026-002',
        'reference' => 'REF-PO-002',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'language' => 'ar',
        'status' => 'SENT',
        'attachments' => ['file_c'],
        'custom_fields' => ['cf_2' => 'value2'],
        'terms' => 'Net 60',
    ];

    $request = UpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PUT', $payload);
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
    expect($dto)->toBeInstanceOf(PurchaseOrderData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid status value on update', function () {
    $request = UpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'WHATEVER'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
