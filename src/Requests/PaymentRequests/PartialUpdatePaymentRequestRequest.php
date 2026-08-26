<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /payment-requests/{id}/` — Partial update payment request.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payment_requests_partial_update.md`. The
 * `PatchedPaymentRequest` schema defines no `required` array, so every
 * field is treated as optional — clients only send the keys they want
 * to mutate.
 *
 * The endpoint's request body shape mirrors {@see CreatePaymentRequestRequest};
 * see that class for the field-by-field description. All fields here use
 * `sometimes` so an empty payload is valid.
 */
class PartialUpdatePaymentRequestRequest extends WafeqFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'amount' => ['sometimes', 'nullable', 'numeric'],

            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            'bank_account' => ['sometimes', 'string'],

            'beneficiary' => ['sometimes', 'string'],

            'bills' => ['sometimes', 'array'],
            'bills.*' => ['string'],

            'charge_type' => ['sometimes', 'string', 'in:OUR,BEN,SHA'],

            'contact' => ['sometimes', 'string'],

            'cost_center' => ['sometimes', 'nullable', 'string'],

            'currency' => ['sometimes', 'string'],

            'details_of_payment' => ['sometimes', 'string', 'max:200'],

            'reference' => ['sometimes', 'string'],

            'send_payment_advice' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'amount',
            'attachments' => 'attachments',
            'bank_account' => 'bank account',
            'beneficiary' => 'beneficiary',
            'bills' => 'bills',
            'charge_type' => 'charge type',
            'contact' => 'contact',
            'cost_center' => 'cost center',
            'currency' => 'currency',
            'details_of_payment' => 'details of payment',
            'reference' => 'reference',
            'send_payment_advice' => 'send payment advice',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PaymentRequestData::class;
    }
}
