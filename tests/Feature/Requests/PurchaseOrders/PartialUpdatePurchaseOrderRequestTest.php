<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\PurchaseOrders\PartialUpdatePurchaseOrderRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['purchase_order_number' => 'PO-2026-003'];

    $request = PartialUpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PurchaseOrderData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payload as valid', function () {
    $request = PartialUpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid status value on partial update', function () {
    $request = PartialUpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id on partial update', function () {
    $request = PartialUpdatePurchaseOrderRequest::create('/purchase-orders/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
