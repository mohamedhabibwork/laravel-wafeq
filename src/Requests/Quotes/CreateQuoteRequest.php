<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Enums\LanguageAc1;
use HWafeq\LaravelWafeq\Enums\TaxAmountType8ab;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /quotes/` — Create quote.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/quotes_create.md`.
 *
 * The endpoint's request body shape (`Estimate` schema, read-write fields):
 *
 *   - `attachments`         array<string>     — file/document ids
 *   - `branch`              string|null       — branch reference
 *   - `contact`             required string   — customer reference
 *   - `currency`            required enum     — ISO currency code
 *   - `custom_fields`       object            — custom field values
 *   - `discount_account`    string            — discount booking account
 *   - `discount_amount`     number            — discount monetary amount
 *   - `discount_cost_center` string           — cost-center for discount
 *   - `discount_tax_rate`   string            — tax-rate for discount
 *   - `exchange_rate`       number|null       — FX to base currency
 *   - `external_id`         string(255)       — caller-provided id
 *   - `language`            enum (default en) — quote language
 *   - `line_items`          required array    — quote line items
 *   - `notes`               string            — free-form notes
 *   - `project`             string|null       — project reference
 *   - `purchase_order`      string            — PO code
 *   - `quote_date`          required date     — issue date (yyyy-mm-dd)
 *   - `quote_number`        required string   — unique quote number
 *   - `reference`           string            — internal reference
 *   - `status`              enum (default DRAFT) — DRAFT | SENT | INVOICED
 *   - `tax_amount_type`     enum              — TAX_INCLUSIVE | TAX_EXCLUSIVE
 *
 * Server-managed (`readOnly`) properties such as `id`, `amount`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id` are
 * intentionally **not** validated.
 */
class CreateQuoteRequest extends WafeqFormRequest
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

            'branch' => ['nullable', 'string'],

            'contact' => ['required', 'string'],

            'currency' => ['required', 'string'],

            'custom_fields' => ['sometimes', 'array'],

            'discount_account' => ['nullable', 'string'],

            'discount_amount' => ['nullable', 'numeric'],

            'discount_cost_center' => ['nullable', 'string'],

            'discount_tax_rate' => ['nullable', 'string'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['nullable', 'string', 'max:255'],

            'language' => ['sometimes', 'string', Rule::enum(LanguageAc1::class)],

            'line_items' => ['required', 'array'],
            'line_items.*' => ['array'],

            'notes' => ['nullable', 'string'],

            'project' => ['nullable', 'string'],

            'purchase_order' => ['nullable', 'string'],

            'quote_date' => ['required', 'date_format:Y-m-d'],

            'quote_number' => ['required', 'string'],

            'reference' => ['nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,INVOICED'],

            'tax_amount_type' => ['nullable', 'string', Rule::enum(TaxAmountType8ab::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'attachments' => 'attachments',
            'branch' => 'branch',
            'contact' => 'contact',
            'currency' => 'currency',
            'custom_fields' => 'custom fields',
            'discount_account' => 'discount account',
            'discount_amount' => 'discount amount',
            'discount_cost_center' => 'discount cost center',
            'discount_tax_rate' => 'discount tax rate',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
            'project' => 'project',
            'purchase_order' => 'purchase order',
            'quote_date' => 'quote date',
            'quote_number' => 'quote number',
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
        return QuoteData::class;
    }
}
