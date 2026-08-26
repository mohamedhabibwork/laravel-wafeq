<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /bills/{id}/` — Update bill.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bills_update.md`. The schema's `required` array also
 * lists server-managed (`readOnly`) fields like `id`, `amount`,
 * `balance`, `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`;
 * those are filtered out and are not validated here.
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
class UpdateBillRequest extends WafeqFormRequest
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
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            'bill_date' => ['required', 'date_format:Y-m-d'],

            'bill_due_date' => ['required', 'date_format:Y-m-d'],

            'bill_number' => ['required', 'string'],

            'branch' => ['nullable', 'string'],

            'contact' => ['nullable', 'string'],

            'currency' => ['required', 'string'],

            'custom_fields' => ['nullable', 'array'],

            'debit_notes' => ['sometimes', 'array'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'language' => ['nullable', 'string', 'in:ar,en'],

            'line_items' => ['required', 'array'],

            'notes' => ['nullable', 'string'],

            'order_number' => ['sometimes', 'nullable', 'string'],

            'project' => ['nullable', 'string'],

            'reference' => ['sometimes', 'nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,AUTHORIZED,PAID'],

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
