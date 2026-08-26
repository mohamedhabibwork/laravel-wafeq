<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Requests\Payslips\UpdatePayslipRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated payslip payload', function () {
    $payload = [
        'branch' => 'branch_main',
        'currency' => 'SAR',
        'employee' => 'emp_1',
        'exchange_rate' => '1.0',
        'external_id' => 'ext-1',
        'language' => 'ar',
        'pay_items' => [
            [
                'account' => 'acc_salary',
                'amount' => '5000.00',
                'cost_center' => 'cc_ops',
                'description' => 'Base salary',
            ],
        ],
        'payslip_date' => '2026-01-15',
        'payslip_number' => 'PS-2026-001',
        'status' => 'POSTED',
    ];

    $request = UpdatePayslipRequest::create('/payslips/ps_1/', 'PUT', $payload);
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

it('rejects a payslip payload missing required fields', function () {
    $request = UpdatePayslipRequest::create('/payslips/ps_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('employee'))->toBeTrue()
        ->and($validator->errors()->has('pay_items'))->toBeTrue()
        ->and($validator->errors()->has('payslip_date'))->toBeTrue()
        ->and($validator->errors()->has('payslip_number'))->toBeTrue();
});

it('rejects an invalid status value', function () {
    $request = UpdatePayslipRequest::create('/payslips/ps_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects a pay_items entry with a non-numeric amount', function () {
    $request = UpdatePayslipRequest::create('/payslips/ps_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $payload = [
        'pay_items' => [
            [
                'account' => 'acc_salary',
                'amount' => 'not-a-number',
                'description' => 'Base salary',
            ],
        ],
    ];

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('pay_items.0.amount'))->toBeTrue();
});
