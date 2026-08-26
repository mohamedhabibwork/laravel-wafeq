<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\PurchaseOrders\CreatePurchaseOrderBillRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts a body-less conversion request', function () {
    $request = CreatePurchaseOrderBillRequest::create('/purchase-orders/po_1/bill/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->rules())->toBe([])
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PurchaseOrderData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});
