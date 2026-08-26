<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\CreditNotes\CreateCreditNoteTaxAuthorityReportRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('accepts a body-less tax-authority report request', function () {
    $request = CreateCreditNoteTaxAuthorityReportRequest::create('/credit-notes/cn_1/tax-authority/report/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->rules())->toBe([])
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CreditNoteData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});
