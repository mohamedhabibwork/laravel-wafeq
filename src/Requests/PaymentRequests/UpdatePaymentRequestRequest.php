<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /payment-requests/{id}/` — Update payment request.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payment_requests_update.md`. The schema's `required`
 * array also lists server-managed (`readOnly`) fields like `id`,
 * `status`, `created_ts`, `modified_ts`, `legacy_id`, `date`,
 * `beneficiary_address`, `beneficiary_name`, `iban`, `swift`; those
 * are filtered out and are not validated here.
 *
 * The endpoint's request body shape mirrors {@see CreatePaymentRequestRequest};
 * see that class for the field-by-field description.
 */
class UpdatePaymentRequestRequest extends WafeqFormRequest
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
            'amount' => ['required', 'nullable', 'numeric'],

            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            'bank_account' => ['required', 'string'],

            'beneficiary' => ['required', 'string'],

            'bills' => ['sometimes', 'array'],
            'bills.*' => ['string'],

            'charge_type' => ['required', 'string', 'in:OUR,BEN,SHA'],

            'contact' => ['required', 'string'],

            'cost_center' => ['nullable', 'string'],

            'currency' => ['required', 'string'],

            'details_of_payment' => ['required', 'string', 'max:200'],

            'reference' => ['required', 'string'],

            'send_payment_advice' => ['required', 'boolean'],
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
