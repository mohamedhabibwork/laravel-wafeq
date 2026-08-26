<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Requests\ManualJournals\UpdateManualJournalRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated manual-journal update payload', function () {
    $payload = [
        'date' => '2026-06-01',
        'reference' => 'MJ-2026-002',
        'notes' => 'Updated adjustment',
    ];

    $request = UpdateManualJournalRequest::create('/manual-journals/abc/', 'PUT', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ManualJournalData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a manual-journal update payload missing the required date', function () {
    $request = UpdateManualJournalRequest::create('/manual-journals/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue();
});

it('rejects an invalid tax_amount_type on the manual-journal update payload', function () {
    $request = UpdateManualJournalRequest::create('/manual-journals/abc/', 'PUT', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'WRONG'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
