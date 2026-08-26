<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /payment-requests/` — Create payment request.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payment_requests_create.md`. The schema's `required`
 * array also lists server-managed (`readOnly`) fields like `id`,
 * `status`, `created_ts`, `modified_ts`, `legacy_id`, `date`,
 * `beneficiary_address`, `beneficiary_name`, `iban`, `swift`; those
 * are filtered out and are not validated here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `amount`               required number|null — non-negative transfer amount
 *   - `attachments`          array<string>       — file/document ids
 *   - `bank_account`         required string      — source bank-account reference
 *   - `beneficiary`          required string      — destination beneficiary
 *   - `bills`                array<string>        — bill references (max 1)
 *   - `charge_type`          required enum        — OUR|BEN|SHA
 *   - `contact`              required string      — contact reference
 *   - `cost_center`          string|null          — cost-center reference
 *   - `currency`             required string      — ISO currency code
 *   - `details_of_payment`   required string(200) — payment description
 *   - `reference`            required string      — tracking reference
 *   - `send_payment_advice`  required boolean     — email advice?
 */
class CreatePaymentRequestRequest extends WafeqFormRequest
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
            // Non-negative transfer amount (required, but nullable).
            'amount' => ['required', 'nullable', 'numeric'],

            // Ids of files / documents attached to this payment request.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Source bank account reference.
            'bank_account' => ['required', 'string'],

            // Destination beneficiary reference.
            'beneficiary' => ['required', 'string'],

            // Bill references — only one allowed per request.
            'bills' => ['sometimes', 'array'],
            'bills.*' => ['string'],

            // OUR | BEN | SHA — who pays the transfer charges.
            'charge_type' => ['required', 'string', 'in:OUR,BEN,SHA'],

            // Contact (vendor / payee) reference.
            'contact' => ['required', 'string'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Free-form payment-purpose description (max 200 chars).
            'details_of_payment' => ['required', 'string', 'max:200'],

            // Tracking reference code.
            'reference' => ['required', 'string'],

            // Should Wafeq email a payment advice?
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
