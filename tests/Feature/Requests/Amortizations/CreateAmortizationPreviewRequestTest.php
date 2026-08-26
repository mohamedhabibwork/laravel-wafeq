<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Requests\Amortizations\CreateAmortizationPreviewRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated amortization-preview payload', function () {
    $payload = [
        'amount' => '12000.00',
        'currency' => 'SAR',
        'description' => 'Annual insurance prepayment',
        'duration' => '12_MONTHS',
        'end_date' => '2026-12-31',
        'recognition_type' => 'MONTHLY',
        'start_date' => '2026-01-01',
    ];

    $request = CreateAmortizationPreviewRequest::create('/amortizations/preview/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(AmortizationData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an amortization-preview payload missing required fields', function () {
    $request = CreateAmortizationPreviewRequest::create('/amortizations/preview/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('description'))->toBeTrue()
        ->and($validator->errors()->has('duration'))->toBeTrue()
        ->and($validator->errors()->has('end_date'))->toBeTrue()
        ->and($validator->errors()->has('recognition_type'))->toBeTrue()
        ->and($validator->errors()->has('start_date'))->toBeTrue();
});

it('rejects an invalid duration enum value', function () {
    $request = CreateAmortizationPreviewRequest::create('/amortizations/preview/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['duration' => '5_MONTHS'],
        ['duration' => $request->rules()['duration']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an invalid recognition_type enum value', function () {
    $request = CreateAmortizationPreviewRequest::create('/amortizations/preview/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['recognition_type' => 'WEEKLY'],
        ['recognition_type' => $request->rules()['recognition_type']],
    );

    expect($validator->fails())->toBeTrue();
});
