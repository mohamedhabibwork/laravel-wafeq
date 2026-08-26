<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /payments/{id}/` — Update payment.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payments_update.md`. The schema's `required` array also
 * lists server-managed (`readOnly`) fields like `id`, `created_ts`,
 * `modified_ts`, `legacy_id`, `payment_request`, `payment_type`; those
 * are filtered out and are not validated here.
 *
 * The endpoint's request body shape mirrors {@see CreatePaymentRequest};
 * see that class for the field-by-field description.
 */
class UpdatePaymentRequest extends WafeqFormRequest
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
            'amount' => ['required', 'numeric'],

            'bill_payments' => ['sometimes', 'array'],

            'contact' => ['nullable', 'string'],

            'cost_center' => ['nullable', 'string'],

            'credit_note_payments' => ['sometimes', 'array'],

            'credit_notes' => ['sometimes', 'array'],

            'currency' => ['required', 'string'],

            'date' => ['required', 'date_format:Y-m-d'],

            'debit_note_payments' => ['sometimes', 'array'],

            'debit_notes' => ['sometimes', 'array'],

            'employee' => ['nullable', 'string'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['nullable', 'string', 'max:255'],

            'invoice_payments' => ['sometimes', 'array'],

            'paid_through_account' => ['required', 'string'],

            'payment_fees' => ['nullable', 'numeric'],

            'payment_fees_account' => ['nullable', 'string'],

            'payslip_payments' => ['sometimes', 'array'],

            'project' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'amount',
            'bill_payments' => 'bill payments',
            'contact' => 'contact',
            'cost_center' => 'cost center',
            'credit_note_payments' => 'credit note payments',
            'credit_notes' => 'credit notes',
            'currency' => 'currency',
            'date' => 'date',
            'debit_note_payments' => 'debit note payments',
            'debit_notes' => 'debit notes',
            'employee' => 'employee',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'invoice_payments' => 'invoice payments',
            'paid_through_account' => 'paid through account',
            'payment_fees' => 'payment fees',
            'payment_fees_account' => 'payment fees account',
            'payslip_payments' => 'payslip payments',
            'project' => 'project',
            'reference' => 'reference',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PaymentData::class;
    }
}
