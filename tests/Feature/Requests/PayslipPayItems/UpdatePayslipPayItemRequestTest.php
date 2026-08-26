<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Requests\PayslipPayItems\UpdatePayslipPayItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated pay item payload', function () {
    $payload = [
        'account' => 'acc_salary',
        'amount' => '5500.00',
        'cost_center' => 'cc_ops',
        'description' => 'Updated salary',
    ];

    $request = UpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(PayslipPayItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(PayslipPayItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a pay item payload missing required fields', function () {
    $request = UpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('account'))->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue();
});

it('rejects a non-numeric amount', function () {
    $request = UpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'not-a-number'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});

it('accepts an optional cost_center as null', function () {
    $request = UpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['cost_center' => null],
        ['cost_center' => $request->rules()['cost_center']],
    );

    expect($validator->fails())->toBeFalse();
});
