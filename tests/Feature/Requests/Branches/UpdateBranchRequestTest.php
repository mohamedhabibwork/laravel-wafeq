<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\Branches\UpdateBranchRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated branch update payload', function () {
    $payload = [
        'address' => ['en' => '456 Olaya St'],
        'building_number' => '5678',
        'city' => ['en' => 'Jeddah'],
        'district' => ['en' => 'Al Andalus'],
        'name' => ['en' => 'Jeddah Branch'],
        'phone' => '+966126543210',
        'postal_code' => '21577',
    ];

    $request = UpdateBranchRequest::create('/branches/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BranchData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an update payload missing required fields', function () {
    $request = UpdateBranchRequest::create('/branches/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('building_number'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue()
        ->and($validator->errors()->has('phone'))->toBeTrue()
        ->and($validator->errors()->has('postal_code'))->toBeTrue();
});
