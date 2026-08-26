<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Requests\Bills\PartialUpdateBillRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['bill_number' => 'BILL-2026-003'];

    $request = PartialUpdateBillRequest::create('/bills/abc/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BillData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payload as valid', function () {
    $request = PartialUpdateBillRequest::create('/bills/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid status value on partial update', function () {
    $request = PartialUpdateBillRequest::create('/bills/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id on partial update', function () {
    $request = PartialUpdateBillRequest::create('/bills/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
