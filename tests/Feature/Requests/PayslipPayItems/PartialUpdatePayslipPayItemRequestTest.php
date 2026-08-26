<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Requests\PayslipPayItems\PartialUpdatePayslipPayItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated pay item payload', function () {
    $payload = [
        'amount' => '5500.00',
        'description' => 'Updated',
    ];

    $request = PartialUpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PATCH', $payload);
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

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a non-numeric amount when supplied', function () {
    $request = PartialUpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'not-a-number'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects a non-string description when supplied', function () {
    $request = PartialUpdatePayslipPayItemRequest::create('/payslips/ps_1/pay-items/pi_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['description' => ['not', 'a', 'string']],
        ['description' => $request->rules()['description']],
    );

    expect($validator->fails())->toBeTrue();
});
