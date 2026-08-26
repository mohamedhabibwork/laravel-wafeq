<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\DebitNotes\PartialUpdateDebitNoteRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['debit_note_number' => 'DN-2026-003'];

    $request = PartialUpdateDebitNoteRequest::create('/debit-notes/abc/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(DebitNoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payload as valid', function () {
    $request = PartialUpdateDebitNoteRequest::create('/debit-notes/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects an invalid status value on partial update', function () {
    $request = PartialUpdateDebitNoteRequest::create('/debit-notes/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['status' => 'NOPE'],
        ['status' => $request->rules()['status']],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long order_number on partial update', function () {
    $request = PartialUpdateDebitNoteRequest::create('/debit-notes/abc/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['order_number' => str_repeat('a', 101)],
        ['order_number' => $request->rules()['order_number']],
    );

    expect($validator->fails())->toBeTrue();
});
