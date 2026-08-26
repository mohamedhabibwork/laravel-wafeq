<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Requests\Projects\CreateProjectRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated project payload', function () {
    $payload = [
        'name' => 'Q1 Marketing Campaign',
        'attachments' => ['file_a', 'file_b'],
    ];

    $request = CreateProjectRequest::create('/projects/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(ProjectData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a project payload missing the name', function () {
    $request = CreateProjectRequest::create('/projects/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an over-long project name', function () {
    $request = CreateProjectRequest::create('/projects/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name' => str_repeat('a', 201)],
        ['name' => $request->rules()['name']],
    );

    expect($validator->fails())->toBeTrue();
});
