<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\Contacts\CreateContactRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated contact payload', function () {
    $payload = [
        'name' => 'Acme Holding Co.',
        'email' => 'billing@acme.example',
        'phone' => '+966112345678',
        'country' => 'SA',
        'city' => 'Riyadh',
        'address' => 'King Fahd Rd',
        'building_number' => '1234',
        'postal_code' => '11564',
        'additional_number' => '5678',
        'district' => 'Olaya',
        'code' => 'CUST-001',
        'external_id' => 'ext-001',
        'tax_registration_number' => '300123456700003',
        'company_identification' => [
            ['type' => 'CRN', 'value' => '1010123456'],
        ],
        'attachments' => ['file_a', 'file_b'],
        'relationship' => ['Customer'],
    ];

    $request = CreateContactRequest::create('/contacts/', 'POST', $payload);
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
    expect($dto)->toBeInstanceOf(ContactData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a contact payload missing the name', function () {
    $request = CreateContactRequest::create('/contacts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an invalid company-identification type', function () {
    $request = CreateContactRequest::create('/contacts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        [
            'name' => 'Test',
            'company_identification' => [
                ['type' => 'NOPE', 'value' => 'x'],
            ],
        ],
        [
            'company_identification' => $request->rules()['company_identification'],
            'company_identification.*' => $request->rules()['company_identification.*'],
            'company_identification.*.type' => $request->rules()['company_identification.*.type'],
            'company_identification.*.value' => $request->rules()['company_identification.*.value'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreateContactRequest::create('/contacts/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
