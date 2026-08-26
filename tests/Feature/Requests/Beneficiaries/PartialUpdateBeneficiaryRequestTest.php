<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Requests\Beneficiaries\PartialUpdateBeneficiaryRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partially-populated beneficiary payload', function () {
    $payload = [
        'bank_name' => 'Saudi National Bank',
        'swift' => 'NCBKSAJE',
    ];

    $request = PartialUpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PATCH', $payload);
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

it('accepts an empty payload (all fields optional on PATCH)', function () {
    $request = PartialUpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid charge_type value', function () {
    $request = PartialUpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['charge_type' => 'NOPE'],
        ['charge_type' => $request->rules()['charge_type']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long bank_name', function () {
    $request = PartialUpdateBeneficiaryRequest::create('/beneficiaries/ben_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['bank_name' => str_repeat('a', 201)],
        ['bank_name' => $request->rules()['bank_name']],
    );

    expect($validator->fails())->toBeTrue();
});
