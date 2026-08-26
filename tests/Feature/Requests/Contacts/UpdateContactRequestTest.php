<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\Contacts\UpdateContactRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated contact update payload', function () {
    $payload = [
        'name' => 'Acme Holding Co.',
        'email' => 'billing@acme.example',
        'phone' => '+966112345678',
        'country' => 'SA',
    ];

    $request = UpdateContactRequest::create('/contacts/abc123/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ContactData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ContactData::class);
});

it('rejects an update payload missing the name', function () {
    $request = UpdateContactRequest::create('/contacts/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an invalid email format', function () {
    $request = UpdateContactRequest::create('/contacts/abc123/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['email' => 'not-an-email'],
        ['email' => $request->rules()['email']],
    );

    expect($validator->fails())->toBeTrue();
});
