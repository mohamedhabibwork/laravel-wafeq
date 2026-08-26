<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Requests\ManualJournals\CreateManualJournalRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated manual-journal payload', function () {
    $payload = [
        'date' => '2026-05-01',
        'reference' => 'MJ-2026-001',
        'notes' => 'Year-end adjustment',
        'external_id' => 'ext-mj-1',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
        'attachments' => ['file_a'],
        'line_items' => [
            ['account' => 'acc_1', 'amount' => '100.00'],
            ['account' => 'acc_2', 'amount' => '-100.00'],
        ],
    ];

    $request = CreateManualJournalRequest::create('/manual-journals/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ManualJournalData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a manual-journal payload missing the required date', function () {
    $request = CreateManualJournalRequest::create('/manual-journals/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('date'))->toBeTrue();
});

it('rejects an invalid tax_amount_type value', function () {
    $request = CreateManualJournalRequest::create('/manual-journals/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'WRONG'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id on a manual-journal payload', function () {
    $request = CreateManualJournalRequest::create('/manual-journals/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
