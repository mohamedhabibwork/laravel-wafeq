<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /payments/{id}/` — Partial update payment.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payments_partial_update.md`. The `PatchedPayment` schema
 * defines no `required` array, so every field is treated as optional —
 * clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape mirrors {@see CreatePaymentRequest};
 * see that class for the field-by-field description. All fields here use
 * `sometimes` so an empty payload is valid.
 */
class PartialUpdatePaymentRequest extends WafeqFormRequest
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
            'amount' => ['sometimes', 'numeric'],

            'bill_payments' => ['sometimes', 'array'],

            'contact' => ['sometimes', 'nullable', 'string'],

            'cost_center' => ['sometimes', 'nullable', 'string'],

            'credit_note_payments' => ['sometimes', 'array'],

            'credit_notes' => ['sometimes', 'array'],

            'currency' => ['sometimes', 'string'],

            'date' => ['sometimes', 'date_format:Y-m-d'],

            'debit_note_payments' => ['sometimes', 'array'],

            'debit_notes' => ['sometimes', 'array'],

            'employee' => ['sometimes', 'nullable', 'string'],

            'exchange_rate' => ['sometimes', 'nullable', 'numeric'],

            'external_id' => ['sometimes', 'string', 'max:255'],

            'invoice_payments' => ['sometimes', 'array'],

            'paid_through_account' => ['sometimes', 'string'],

            'payment_fees' => ['sometimes', 'nullable', 'numeric'],

            'payment_fees_account' => ['sometimes', 'nullable', 'string'],

            'payslip_payments' => ['sometimes', 'array'],

            'project' => ['sometimes', 'nullable', 'string'],

            'reference' => ['sometimes', 'string'],
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
