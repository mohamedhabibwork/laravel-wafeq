<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Requests\Beneficiaries\UpdateBeneficiaryRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated beneficiary payload', function () {
    $payload = [
        'address' => '123 King Fahd Rd, Riyadh',
        'bank_name' => 'Al Rajhi Bank',
        'charge_type' => 'SHA',
        'contacts' => ['contact_1', 'contact_2'],
        'country' => 'SA',
        'currency' => 'SAR',
        'iban' => 'SA0380000000608010167519',
        'name' => 'Acme Supplier Co',
        'swift' => 'RJHISARI',
    ];

    $request = UpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BeneficiaryData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(BeneficiaryData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a beneficiary payload missing required fields', function () {
    $request = UpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('address'))->toBeTrue()
        ->and($validator->errors()->has('country'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('iban'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects an invalid charge_type value', function () {
    $request = UpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['charge_type' => 'NOPE'],
        ['charge_type' => $request->rules()['charge_type']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long swift code', function () {
    $request = UpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['swift' => str_repeat('A', 12)],
        ['swift' => $request->rules()['swift']],
    );

    expect($validator->fails())->toBeTrue();
});
