<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /payments/` — Create payment.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/payments_create.md`. The schema's `required` array also
 * lists server-managed (`readOnly`) fields like `id`, `created_ts`,
 * `modified_ts`, `legacy_id`, `payment_request`, `payment_type`; those
 * are filtered out and are not validated here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `amount`                 required number   — total payment amount
 *   - `bill_payments`          array             — bill-payment lines
 *   - `contact`                string            — contact reference
 *   - `cost_center`            string|null       — cost-center reference
 *   - `credit_note_payments`   array             — credit-note lines
 *   - `credit_notes`           array             — customer-advance lines
 *   - `currency`               required string   — ISO currency code
 *   - `date`                   required date     — payment date
 *   - `debit_note_payments`    array             — debit-note lines
 *   - `debit_notes`            array             — supplier-advance lines
 *   - `employee`               string            — employee reference
 *   - `exchange_rate`          number|null       — FX to base currency
 *   - `external_id`            string(255)       — caller-provided id
 *   - `invoice_payments`       array             — invoice-payment lines
 *   - `paid_through_account`   required string   — payment account
 *   - `payment_fees`           number            — bank charges
 *   - `payment_fees_account`   string|null       — fees-account reference
 *   - `payslip_payments`       array             — payslip-payment lines
 *   - `project`                string|null       — project reference
 *   - `reference`              string            — internal reference
 */
class CreatePaymentRequest extends WafeqFormRequest
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
            // Total payment amount in the payment currency.
            'amount' => ['required', 'numeric'],

            // Bill-payment lines (each carries bill id + amount pair).
            'bill_payments' => ['sometimes', 'array'],

            // Contact reference (vendor / customer).
            'contact' => ['nullable', 'string'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Credit-note payment applications.
            'credit_note_payments' => ['sometimes', 'array'],

            // Customer-advance block (auto-generates a credit note).
            'credit_notes' => ['sometimes', 'array'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Date the payment was made / received.
            'date' => ['required', 'date_format:Y-m-d'],

            // Debit-note payment applications.
            'debit_note_payments' => ['sometimes', 'array'],

            // Supplier-advance block (auto-generates a debit note).
            'debit_notes' => ['sometimes', 'array'],

            // Employee reference — required for payslip payments.
            'employee' => ['nullable', 'string'],

            // FX rate to the organisation's base currency at the
            // payment date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['nullable', 'string', 'max:255'],

            // Invoice-payment applications.
            'invoice_payments' => ['sometimes', 'array'],

            // Account used for this payment (bank / cash account).
            'paid_through_account' => ['required', 'string'],

            // Bank charges or residual FX / rounding difference.
            'payment_fees' => ['nullable', 'numeric'],

            // Account categorising payment_fees (e.g. Exchange Gain/Loss).
            'payment_fees_account' => ['nullable', 'string'],

            // Payslip-payment applications.
            'payslip_payments' => ['sometimes', 'array'],

            // Optional project tagging.
            'project' => ['nullable', 'string'],

            // Optional internal reference / doc number.
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
