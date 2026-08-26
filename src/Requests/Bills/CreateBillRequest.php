<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /bills/` — Create bill.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bills_create.md`. Server-managed (`readOnly`) fields
 * (`id`, `amount`, `balance`, `tax_amount`, `created_ts`, `modified_ts`,
 * `legacy_id`) are filtered out and not validated here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`      array<string>      — file/document ids
 *   - `bill_date`        required date      — issue date (yyyy-mm-dd)
 *   - `bill_due_date`    required date      — payment-due date (yyyy-mm-dd)
 *   - `bill_number`      required string    — unique bill number
 *   - `branch`           string|null        — branch reference
 *   - `contact`          string|null        — vendor contact reference
 *   - `currency`         required string    — ISO-4217 currency code
 *   - `custom_fields`    object             — custom field id → value
 *   - `debit_notes`      array<object>      — applied debit notes
 *   - `exchange_rate`    number|null        — FX to base currency
 *   - `external_id`      string(255)        — caller-provided id (default "")
 *   - `language`         enum ar|en         — printable document language
 *   - `line_items`       required array     — bill line items
 *   - `notes`            string|null        — free-form notes
 *   - `order_number`     string             — associated order number (default "")
 *   - `project`          string|null        — project reference
 *   - `reference`        string             — internal reference code (default "")
 *   - `status`           enum DRAFT|AUTHORIZED|PAID — defaults to DRAFT
 *   - `tax_amount_type`  enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 */
class CreateBillRequest extends WafeqFormRequest
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
            // Ids of files / documents attached to this bill.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Date when the bill was issued (ISO-8601 yyyy-mm-dd).
            'bill_date' => ['required', 'date_format:Y-m-d'],

            // Date by which the bill should be paid (ISO-8601 yyyy-mm-dd).
            'bill_due_date' => ['required', 'date_format:Y-m-d'],

            // Unique identifier / number assigned to this bill.
            'bill_number' => ['required', 'string'],

            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // Vendor contact reference (nullable in schema).
            'contact' => ['nullable', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Optional mapping of custom field ids to values.
            'custom_fields' => ['nullable', 'array'],

            // Debit notes applied to this bill for payment / adjustment.
            'debit_notes' => ['sometimes', 'array'],

            // FX rate to the organisation's base currency at the
            // document date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Printable document language (ar | en).
            'language' => ['nullable', 'string', 'in:ar,en'],

            // Bill line items.
            'line_items' => ['required', 'array'],

            // Free-form notes / comments.
            'notes' => ['nullable', 'string'],

            // Associated order number (defaults to "").
            'order_number' => ['sometimes', 'nullable', 'string'],

            // Optional project tagging.
            'project' => ['nullable', 'string'],

            // Optional internal reference (defaults to "").
            'reference' => ['sometimes', 'nullable', 'string'],

            // Bill status — defaults to DRAFT.
            'status' => ['sometimes', 'string', 'in:DRAFT,AUTHORIZED,PAID'],

            // TAX_INCLUSIVE | TAX_EXCLUSIVE.
            'tax_amount_type' => ['nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'attachments' => 'attachments',
            'bill_date' => 'bill date',
            'bill_due_date' => 'bill due date',
            'bill_number' => 'bill number',
            'branch' => 'branch',
            'contact' => 'contact',
            'currency' => 'currency',
            'custom_fields' => 'custom fields',
            'debit_notes' => 'debit notes',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
            'order_number' => 'order number',
            'project' => 'project',
            'reference' => 'reference',
            'status' => 'status',
            'tax_amount_type' => 'tax amount type',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BillData::class;
    }
}
