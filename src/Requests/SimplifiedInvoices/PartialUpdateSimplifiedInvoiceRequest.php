<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Enums\LanguageAc1;
use HWafeq\LaravelWafeq\Enums\TaxAmountType8ab;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /simplified-invoices/{id}/` — Partial update simplified invoice.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/simplified_invoices_partial_update.md`. The schema is
 * identical to {@see CreateSimplifiedInvoiceRequest}; partial updates
 * are flagged by PATCH and the server treats absent fields as no-ops.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `branch`                string|null       — branch reference
 *   - `contact`               required string   — recipient reference
 *   - `currency`              required enum     — ISO currency code
 *   - `exchange_rate`         number|null       — FX to base currency
 *   - `external_id`           string(255)       — caller-provided id
 *   - `invoice_date`          required date     — issue date (yyyy-mm-dd)
 *   - `invoice_number`        required string   — unique invoice number (max 100)
 *   - `language`              enum (default en) — invoice language
 *   - `line_items`            required array    — invoice line items
 *   - `notes`                 string            — free-form notes
 *   - `paid_through_account`  required string   — payment source account
 *   - `place_of_supply`       string            — UAE place of supply
 *   - `project`               string|null       — project reference
 *   - `reference`             string            — internal reference
 *   - `status`                enum (default DRAFT) — DRAFT | PAID
 *   - `tax_amount_type`       enum              — TAX_INCLUSIVE | TAX_EXCLUSIVE
 *   - `warehouse`             string|null       — warehouse reference
 *
 * Server-managed (`readOnly`) properties such as `id`, `amount`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id` are
 * intentionally **not** validated.
 */
class PartialUpdateSimplifiedInvoiceRequest extends WafeqFormRequest
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
            'branch' => ['nullable', 'string'],

            'contact' => ['required', 'string'],

            'currency' => ['required', 'string'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['nullable', 'string', 'max:255'],

            'invoice_date' => ['required', 'date_format:Y-m-d'],

            'invoice_number' => ['required', 'string', 'max:100'],

            'language' => ['sometimes', 'string', Rule::enum(LanguageAc1::class)],

            'line_items' => ['required', 'array'],
            'line_items.*' => ['array'],

            'notes' => ['nullable', 'string'],

            'paid_through_account' => ['required', 'string'],

            'place_of_supply' => ['nullable', 'string'],

            'project' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,PAID'],

            'tax_amount_type' => ['nullable', 'string', Rule::enum(TaxAmountType8ab::class)],

            'warehouse' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'branch' => 'branch',
            'contact' => 'contact',
            'currency' => 'currency',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'invoice_date' => 'invoice date',
            'invoice_number' => 'invoice number',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
            'paid_through_account' => 'paid through account',
            'place_of_supply' => 'place of supply',
            'project' => 'project',
            'reference' => 'reference',
            'status' => 'status',
            'tax_amount_type' => 'tax amount type',
            'warehouse' => 'warehouse',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return SimplifiedInvoiceData::class;
    }
}
