<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\Contacts\PartialUpdateContactRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts an empty partial-update body', function () {
    $request = PartialUpdateContactRequest::create('/contacts/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ContactData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('accepts a sparse partial-update body', function () {
    $payload = [
        'email' => 'new@example.com',
        'phone' => '+966112345678',
    ];

    $request = PartialUpdateContactRequest::create('/contacts/abc123/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ContactData::class);
});

it('rejects an invalid email format on partial update', function () {
    $request = PartialUpdateContactRequest::create('/contacts/abc123/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['email' => 'not-an-email'],
        ['email' => $request->rules()['email']],
    );

    expect($validator->fails())->toBeTrue();
});
