<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Requests\SimplifiedInvoices\CreateSimplifiedInvoiceTaxAuthorityReportRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('exposes no validation rules for the simplified-invoice tax-authority report', function () {
    $request = CreateSimplifiedInvoiceTaxAuthorityReportRequest::create('/simplified-invoices/sinv_1/tax-authority/report/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()->toBeEmpty()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(SimplifiedInvoiceData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('materialises a SimplifiedInvoiceData from a minimal payload', function () {
    $payload = ['id' => 'sinv_1'];

    $request = CreateSimplifiedInvoiceTaxAuthorityReportRequest::create('/simplified-invoices/sinv_1/tax-authority/report/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(SimplifiedInvoiceData::class);
});

it('rejects no fields because there is no body', function () {
    $request = CreateSimplifiedInvoiceTaxAuthorityReportRequest::create('/simplified-invoices/sinv_1/tax-authority/report/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(['any_field' => 'any_value'], $request->rules());
    expect($validator->fails())->toBeFalse();
});
