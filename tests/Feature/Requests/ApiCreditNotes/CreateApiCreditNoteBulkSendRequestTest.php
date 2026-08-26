<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Requests\ApiCreditNotes\CreateApiCreditNoteBulkSendRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated api-credit-note bulk-send payload', function () {
    $payload = [
        'channels' => [
            [
                'data' => [
                    'message' => '<p>Credit note attached.</p>',
                    'recipients' => [
                        'to' => ['ahmed.a@example.com'],
                        'cc' => [],
                        'bcc' => [],
                    ],
                    'subject' => 'Credit Note X',
                ],
                'medium' => 'email',
            ],
        ],
        'contact' => [
            'address' => 'Riyadh',
            'email' => 'ahmed@example.com',
            'name' => 'Ahmed A.',
        ],
        'credit_note_date' => '2026-01-15',
        'credit_note_number' => 'CN-BULK-001',
        'currency' => 'SAR',
        'language' => 'en',
        'line_items' => [
            [
                'account' => 'acc_1',
                'description' => 'Credit line 1',
                'name' => 'Item name',
                'price' => '40',
                'quantity' => '2',
                'tax_rate' => [
                    'name' => 'VAT 15%',
                    'rate' => '15',
                ],
            ],
        ],
        'paid_through_account' => 'bank_1',
        'reference' => 'REF-1',
        'tax_amount_type' => 'TAX_INCLUSIVE',
    ];

    $request = CreateApiCreditNoteBulkSendRequest::create('/api-credit-notes/bulk-send/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ApiCreditNoteData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ApiCreditNoteData::class)
        ->and($dto->id)->toBe('');
});

it('rejects a bulk-send payload missing required fields', function () {
    $request = CreateApiCreditNoteBulkSendRequest::create('/api-credit-notes/bulk-send/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('channels'))->toBeTrue()
        ->and($validator->errors()->has('contact'))->toBeTrue()
        ->and($validator->errors()->has('credit_note_date'))->toBeTrue()
        ->and($validator->errors()->has('credit_note_number'))->toBeTrue()
        ->and($validator->errors()->has('currency'))->toBeTrue()
        ->and($validator->errors()->has('language'))->toBeTrue()
        ->and($validator->errors()->has('line_items'))->toBeTrue()
        ->and($validator->errors()->has('tax_amount_type'))->toBeTrue();
});

it('rejects an invalid language value', function () {
    $request = CreateApiCreditNoteBulkSendRequest::create('/api-credit-notes/bulk-send/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['language' => 'fr'],
        ['language' => $request->rules()['language']],
    );

    expect($validator->fails())->toBeTrue();
});
