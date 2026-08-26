<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Requests\Projects\UpdateProjectRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated project update payload', function () {
    $payload = [
        'name' => 'Q1 Marketing Campaign v2',
        'attachments' => ['file_a'],
    ];

    $request = UpdateProjectRequest::create('/projects/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ProjectData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ProjectData::class);
});

it('rejects an update payload missing the name', function () {
    $request = UpdateProjectRequest::create('/projects/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects a non-string attachment entry', function () {
    $request = UpdateProjectRequest::create('/projects/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['attachments' => ['file_a', 123]],
        ['attachments' => $request->rules()['attachments'], 'attachments.*' => $request->rules()['attachments.*']],
    );

    expect($validator->fails())->toBeTrue();
});
