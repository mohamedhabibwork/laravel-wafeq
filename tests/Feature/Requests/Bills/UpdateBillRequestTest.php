<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Requests\Bills\UpdateBillRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated bill update payload', function () {
    $payload = [
        'bill_date' => '2026-04-01',
        'bill_due_date' => '2026-04-30',
        'bill_number' => 'BILL-2026-002',
        'currency' => 'AED',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Item B', 'quantity' => '2.00', 'unit_amount' => '50.00'],
        ],
        'contact' => 'vendor_2',
        'branch' => 'branch_main',
        'project' => 'proj_y',
        'exchange_rate' => '3.67',
        'notes' => 'Updated bill',
        'external_id' => 'ext-2',
        'order_number' => 'PO-002',
        'reference' => 'REF-002',
        'tax_amount_type' => 'TAX_INCLUSIVE',
        'language' => 'ar',
        'status' => 'AUTHORIZED',
        'attachments' => ['file_c'],
        'custom_fields' => ['cf_2' => 'value2'],
    ];

    $request = UpdateBillRequest::create('/bills/abc/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BillData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BillData::class);
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateBillRequest::create('/bills/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('bill_date'))->toBeTrue()
        ->and($validator->errors()->has('bill_due_date'))->toBeTrue()
        ->and($validator->errors()->has('bill_number'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue();
});

it('rejects an invalid status value on update', function () {
    $request = UpdateBillRequest::create('/bills/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'WHATEVER'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});
