<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Requests\CustomFields\PartialUpdateCustomFieldRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CustomFieldData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'is_active' => false,
        'name' => 'Renamed',
    ];

    $request = PartialUpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(CustomFieldData::class);
});

it('rejects an invalid apply_to entry on partial update', function () {
    $request = PartialUpdateCustomFieldRequest::create('/custom-fields/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['apply_to' => ['NOPE']],
        ['apply_to' => $request->rules()['apply_to'], 'apply_to.*' => $request->rules()['apply_to.*']],
    );

    expect($validator->fails())->toBeTrue();
});
