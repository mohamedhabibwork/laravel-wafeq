<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Requests\Invoices\CreateInvoiceTaxAuthorityReportRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('exposes no validation rules for the tax-authority report endpoint', function () {
    $request = CreateInvoiceTaxAuthorityReportRequest::create('/invoices/inv_1/tax-authority/report/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()->toBeEmpty()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(InvoiceData::class);

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('materialises an InvoiceData from a minimal payload', function () {
    $payload = ['id' => 'inv_1'];

    $request = CreateInvoiceTaxAuthorityReportRequest::create('/invoices/inv_1/tax-authority/report/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(InvoiceData::class);
});

it('rejects no fields because there is no body', function () {
    $request = CreateInvoiceTaxAuthorityReportRequest::create('/invoices/inv_1/tax-authority/report/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(['any_field' => 'any_value'], $request->rules());
    expect($validator->fails())->toBeFalse();
});
