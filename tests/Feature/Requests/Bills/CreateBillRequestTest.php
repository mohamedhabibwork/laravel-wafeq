<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Requests\Bills\CreateBillRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated bill create payload', function () {
    $payload = [
        'bill_date' => '2026-03-01',
        'bill_due_date' => '2026-03-31',
        'bill_number' => 'BILL-2026-001',
        'currency' => 'SAR',
        'line_items' => [
            ['account' => 'acc_1', 'description' => 'Item A', 'quantity' => '1.00', 'unit_amount' => '100.00'],
        ],
        'contact' => 'vendor_1',
        'branch' => 'branch_main',
        'project' => 'proj_x',
        'exchange_rate' => '3.75',
        'notes' => 'Monthly bill',
        'external_id' => 'ext-1',
        'order_number' => 'PO-001',
        'reference' => 'REF-001',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'language' => 'en',
        'status' => 'DRAFT',
        'attachments' => ['file_a', 'file_b'],
        'custom_fields' => ['cf_1' => 'value'],
    ];

    $request = CreateBillRequest::create('/bills/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(BillData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a bill payload missing required fields', function () {
    $request = CreateBillRequest::create('/bills/', 'POST', []);
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

it('rejects an invalid status value', function () {
    $request = CreateBillRequest::create('/bills/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an invalid language value', function () {
    $request = CreateBillRequest::create('/bills/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['language' => 'fr'],
        ['language' => $request->rules()['language']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreateBillRequest::create('/bills/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
