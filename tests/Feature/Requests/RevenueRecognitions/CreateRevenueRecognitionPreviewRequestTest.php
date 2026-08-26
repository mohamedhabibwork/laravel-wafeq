<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Requests\RevenueRecognitions\CreateRevenueRecognitionPreviewRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated revenue-recognition-preview payload', function () {
    $payload = [
        'amount' => '24000.00',
        'currency' => 'SAR',
        'description' => 'Annual service contract',
        'duration' => '12_MONTHS',
        'end_date' => '2026-12-31',
        'recognition_type' => 'MONTHLY',
        'start_date' => '2026-01-01',
    ];

    $request = CreateRevenueRecognitionPreviewRequest::create('/revenue-recognitions/preview/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(RevenueRecognitionData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a revenue-recognition-preview payload missing required fields', function () {
    $request = CreateRevenueRecognitionPreviewRequest::create('/revenue-recognitions/preview/', 'POST', []);
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

it('rejects an invalid duration value on the revenue-recognition-preview payload', function () {
    $request = CreateRevenueRecognitionPreviewRequest::create('/revenue-recognitions/preview/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['duration' => '5_MONTHS'],
        ['duration' => $request->rules()['duration']],
    );

    expect($validator->fails())->toBeTrue();
});
