<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Requests\RevenueRecognitions\CreateRevenueRecognitionEndEarlyRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated revenue-recognition end-early payload', function () {
    $payload = [
        'amount' => '5000.00',
        'end_early_account' => 'acc_1',
        'end_early_date' => '2026-07-01',
        'notes' => 'Contract cancelled early.',
    ];

    $request = CreateRevenueRecognitionEndEarlyRequest::create('/revenue-recognitions/abc/end-early/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(RevenueRecognitionData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a revenue-recognition end-early payload missing required fields', function () {
    $request = CreateRevenueRecognitionEndEarlyRequest::create('/revenue-recognitions/abc/end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('amount'))->toBeTrue()
        ->and($validator->errors()->has('end_early_account'))->toBeTrue()
        ->and($validator->errors()->has('end_early_date'))->toBeTrue()
        ->and($validator->errors()->has('notes'))->toBeTrue();
});

it('rejects a non-numeric amount on the revenue-recognition end-early payload', function () {
    $request = CreateRevenueRecognitionEndEarlyRequest::create('/revenue-recognitions/abc/end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['amount' => 'five thousand'],
        ['amount' => $request->rules()['amount']],
    );

    expect($validator->fails())->toBeTrue();
});
