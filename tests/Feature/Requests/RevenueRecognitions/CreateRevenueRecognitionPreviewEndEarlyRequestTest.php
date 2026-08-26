<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Requests\RevenueRecognitions\CreateRevenueRecognitionPreviewEndEarlyRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a revenue-recognition preview-end-early payload', function () {
    $payload = [
        'date' => '2026-08-01',
    ];

    $request = CreateRevenueRecognitionPreviewEndEarlyRequest::create('/revenue-recognitions/abc/preview-end-early/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(RevenueRecognitionData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a revenue-recognition preview-end-early payload missing the date', function () {
    $request = CreateRevenueRecognitionPreviewEndEarlyRequest::create('/revenue-recognitions/abc/preview-end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue();
});

it('rejects a malformed date on the preview-end-early payload', function () {
    $request = CreateRevenueRecognitionPreviewEndEarlyRequest::create('/revenue-recognitions/abc/preview-end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => '2026-08'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
