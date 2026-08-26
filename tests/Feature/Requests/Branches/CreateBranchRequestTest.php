<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\Branches\CreateBranchRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated branch payload', function () {
    $payload = [
        'address' => ['en' => '123 King Fahd Rd', 'ar' => 'طريق الملك فهد ١٢٣'],
        'building_number' => '1234',
        'city' => ['en' => 'Riyadh', 'ar' => 'الرياض'],
        'district' => ['en' => 'Olaya', 'ar' => 'العليا'],
        'is_active' => true,
        'name' => ['en' => 'Riyadh HQ', 'ar' => 'مقر الرياض'],
        'phone' => '+966112345678',
        'postal_code' => '11564',
    ];

    $request = CreateBranchRequest::create('/branches/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(BranchData::class);
});

it('rejects a branch payload missing required fields', function () {
    $request = CreateBranchRequest::create('/branches/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('address'))->toBeTrue()
        ->and($validator->errors()->has('building_number'))->toBeTrue()
        ->and($validator->errors()->has('city'))->toBeTrue()
        ->and($validator->errors()->has('district'))->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue()
        ->and($validator->errors()->has('phone'))->toBeTrue()
        ->and($validator->errors()->has('postal_code'))->toBeTrue();
});

it('rejects a localised object missing the english text', function () {
    $request = CreateBranchRequest::create('/branches/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['name' => ['ar' => 'بدون إنجليزي']],
        [
            'name' => $request->rules()['name'],
            'name.en' => $request->rules()['name.en'],
            'name.ar' => $request->rules()['name.ar'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});
