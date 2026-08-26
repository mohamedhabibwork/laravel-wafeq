<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Requests\ApiInvoices\CreateApiInvoiceBulkSendRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated api-invoice bulk-send payload', function () {
    $payload = [
        'channels' => [
            [
                'data' => [
                    'message' => '<p>Invoice attached.</p>',
                    'recipients' => [
                        'to' => ['ahmed.a@example.com'],
                        'cc' => ['cc@example.com'],
                        'bcc' => ['bcc@example.com'],
                    ],
                    'subject' => 'Invoice X',
                ],
                'medium' => 'email',
            ],
        ],
        'contact' => [
            'address' => 'Riyadh',
            'city' => 'Riyadh',
            'country' => 'SA',
            'email' => 'ahmed@example.com',
            'name' => 'Ahmed A.',
            'tax_registration_number' => '300000000000003',
        ],
        'currency' => 'SAR',
        'invoice_date' => '2026-01-15',
        'invoice_number' => 'INV-BULK-001',
        'language' => 'en',
        'line_items' => [
            [
                'account' => 'acc_1',
                'description' => 'Item 1',
                'name' => 'Item name 1',
                'price' => '40',
                'quantity' => '2',
                'tax_rate' => [
                    'name' => 'VAT 15%',
                    'rate' => '15',
                    'suid' => 'tax_1',
                ],
            ],
        ],
        'notes' => 'thanks',
        'paid_through_account' => 'bank_1',
        'reference' => 'REF-1',
        'tax_amount_type' => 'TAX_INCLUSIVE',
    ];

    $request = CreateApiInvoiceBulkSendRequest::create('/api-invoices/bulk-send/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ApiInvoiceData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ApiInvoiceData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a bulk-send payload missing required fields', function () {
    $request = CreateApiInvoiceBulkSendRequest::create('/api-invoices/bulk-send/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('channels'))->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('invoice_date'))->toBeTrue()
        ->and($validator->errors()->has('invoice_number'))->toBeTrue()
        ->and($validator->errors()->has('language'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue()
        ->and($validator->errors()->has('tax_amount_type'))->toBeTrue();
});

it('rejects an invalid tax_amount_type value', function () {
    $request = CreateApiInvoiceBulkSendRequest::create('/api-invoices/bulk-send/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['tax_amount_type' => 'NOPE'],
        ['tax_amount_type' => $request->rules()['tax_amount_type']],
    );

    expect($validator->fails())->toBeTrue();
});
