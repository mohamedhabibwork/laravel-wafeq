<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Requests\Projects\PartialUpdateProjectRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateProjectRequest::create('/projects/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ProjectData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'name' => 'Renamed Project',
    ];

    $request = PartialUpdateProjectRequest::create('/projects/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ProjectData::class);
});

it('rejects an over-long name on partial update', function () {
    $request = PartialUpdateProjectRequest::create('/projects/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name' => str_repeat('a', 201)],
        ['name' => $request->rules()['name']],
    );

    expect($validator->fails())->toBeTrue();
});
