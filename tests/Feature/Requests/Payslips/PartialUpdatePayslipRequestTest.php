<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Requests\Payslips\PartialUpdatePayslipRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated payslip payload', function () {
    $payload = [
        'status' => 'POSTED',
        'payslip_date' => '2026-02-01',
    ];

    $request = PartialUpdatePayslipRequest::create('/payslips/ps_1/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PayslipData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(PayslipData::class)
        ->and($dto->id)->toBe('');
});

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdatePayslipRequest::create('/payslips/ps_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid status value', function () {
    $request = PartialUpdatePayslipRequest::create('/payslips/ps_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = PartialUpdatePayslipRequest::create('/payslips/ps_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
