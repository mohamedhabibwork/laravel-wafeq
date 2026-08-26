<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Enums\LanguageAc1;
use HWafeq\LaravelWafeq\Enums\TaxAmountType8ab;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /invoices/` — Create invoice.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/invoices_create.md`.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`         array<string>     — file/document ids
 *   - `branch`              string|null       — branch reference
 *   - `contact`             required string   — customer reference
 *   - `credit_notes`        array             — applied credit notes
 *   - `currency`            required enum     — ISO currency code
 *   - `custom_fields`       object            — custom field values
 *   - `discount_account`    string            — discount booking account
 *   - `discount_amount`     number            — discount monetary amount
 *   - `discount_cost_center` string           — cost-center for discount
 *   - `discount_tax_rate`   string            — tax-rate for discount
 *   - `exchange_rate`       number|null       — FX to base currency
 *   - `external_id`         string(255)       — caller-provided id
 *   - `invoice_date`        required date     — issue date (yyyy-mm-dd)
 *   - `invoice_due_date`    required date     — due date (yyyy-mm-dd)
 *   - `invoice_number`      required string   — unique invoice number
 *   - `language`            enum (default en) — invoice language
 *   - `line_items`          required array    — invoice line items
 *   - `notes`               string            — free-form notes
 *   - `place_of_supply`     string            — UAE place of supply
 *   - `project`             string|null       — project reference
 *   - `purchase_order`      string            — PO code
 *   - `reference`           string            — internal reference
 *   - `status`              enum (default DRAFT)
 *   - `tax_amount_type`     enum              — TAX_INCLUSIVE / TAX_EXCLUSIVE
 *   - `warehouse`           string|null       — warehouse reference
 *
 * Server-managed (`readOnly`) properties such as `id`, `amount`,
 * `balance`, `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`
 * are intentionally **not** validated — they are returned by the API
 * and must never be client-sent.
 */
class CreateInvoiceRequest extends WafeqFormRequest
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
            // Ids of files / documents attached to this invoice.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // Customer / contact id.
            'contact' => ['required', 'string'],

            // Credit notes applied to this invoice (nested objects).
            'credit_notes' => ['sometimes', 'array'],
            'credit_notes.*' => ['array'],

            // ISO-4217 currency code.
            'currency' => ['required', 'string'],

            // Custom field values keyed by field id.
            'custom_fields' => ['sometimes', 'array'],

            // Account that absorbs the discount (if any).
            'discount_account' => ['nullable', 'string'],

            // Monetary discount amount.
            'discount_amount' => ['nullable', 'numeric'],

            // Cost-center that absorbs the discount.
            'discount_cost_center' => ['nullable', 'string'],

            // Tax rate applied on the discount.
            'discount_tax_rate' => ['nullable', 'string'],

            // FX rate to the organisation's base currency.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['nullable', 'string', 'max:255'],

            // Issue date (ISO-8601 yyyy-mm-dd).
            'invoice_date' => ['required', 'date_format:Y-m-d'],

            // Due date (ISO-8601 yyyy-mm-dd).
            'invoice_due_date' => ['required', 'date_format:Y-m-d'],

            // Caller-provided invoice number.
            'invoice_number' => ['required', 'string'],

            // Language code (ar | en) — defaults to en.
            'language' => ['sometimes', 'string', Rule::enum(LanguageAc1::class)],

            // Line items on the invoice.
            'line_items' => ['required', 'array'],
            'line_items.*' => ['array'],

            // Free-form notes displayed on the invoice.
            'notes' => ['nullable', 'string'],

            // UAE place of supply (enum-like string).
            'place_of_supply' => ['nullable', 'string'],

            // Optional project association.
            'project' => ['nullable', 'string'],

            // Purchase-order code.
            'purchase_order' => ['nullable', 'string'],

            // Internal reference / doc number.
            'reference' => ['nullable', 'string'],

            // Lifecycle state — defaults to DRAFT.
            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,FINALIZED'],

            // TAX_INCLUSIVE | TAX_EXCLUSIVE.
            'tax_amount_type' => ['nullable', 'string', Rule::enum(TaxAmountType8ab::class)],

            // Optional warehouse association.
            'warehouse' => ['nullable', 'string'],
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
            'credit_notes' => 'credit notes',
            'currency' => 'currency',
            'custom_fields' => 'custom fields',
            'discount_account' => 'discount account',
            'discount_amount' => 'discount amount',
            'discount_cost_center' => 'discount cost center',
            'discount_tax_rate' => 'discount tax rate',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'invoice_date' => 'invoice date',
            'invoice_due_date' => 'invoice due date',
            'invoice_number' => 'invoice number',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
            'place_of_supply' => 'place of supply',
            'project' => 'project',
            'purchase_order' => 'purchase order',
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
        return InvoiceData::class;
    }
}
