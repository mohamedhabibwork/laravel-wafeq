<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Requests\Amortizations\CreateAmortizationPreviewEndEarlyRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates an amortization preview-end-early payload', function () {
    $payload = [
        'date' => '2026-08-01',
    ];

    $request = CreateAmortizationPreviewEndEarlyRequest::create('/amortizations/abc/preview-end-early/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(AmortizationData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an amortization preview-end-early payload missing the date', function () {
    $request = CreateAmortizationPreviewEndEarlyRequest::create('/amortizations/abc/preview-end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue();
});

it('rejects a malformed date on the preview-end-early payload', function () {
    $request = CreateAmortizationPreviewEndEarlyRequest::create('/amortizations/abc/preview-end-early/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['date' => 'August 1, 2026'],
        ['date' => $request->rules()['date']],
    );

    expect($validator->fails())->toBeTrue();
});
