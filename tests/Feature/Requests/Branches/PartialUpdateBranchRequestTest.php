<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\Branches\PartialUpdateBranchRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateBranchRequest::create('/branches/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BranchData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'phone' => '+966112345678',
        'is_active' => false,
    ];

    $request = PartialUpdateBranchRequest::create('/branches/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BranchData::class);
});

it('rejects a localised object provided without the english key', function () {
    $request = PartialUpdateBranchRequest::create('/branches/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['city' => ['ar' => 'جدة فقط']],
        [
            'city' => $request->rules()['city'],
            'city.en' => $request->rules()['city.en'],
            'city.ar' => $request->rules()['city.ar'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});
