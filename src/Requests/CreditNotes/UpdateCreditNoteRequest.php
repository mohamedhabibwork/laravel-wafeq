<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /credit-notes/{id}/` — Update credit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/credit_notes_update.md`. Server-managed (`readOnly`)
 * fields (`id`, `amount`, `balance`, `tax_amount`, `created_ts`,
 * `modified_ts`, `legacy_id`) are filtered out and are not validated
 * here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             required string    — customer contact reference
 *   - `credit_note_date`    required date      — issue date (yyyy-mm-dd)
 *   - `credit_note_number`  required string    — unique credit-note number
 *   - `currency`            required string    — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `discount_cost_center` string|null       — discount cost-center reference
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id (default "")
 *   - `language`            enum ar|en         — printable document language
 *   - `line_items`          required array     — credit-note line items
 *   - `notes`               string|null        — free-form notes
 *   - `place_of_supply`     string|null        — place of supply
 *   - `project`             string|null        — project reference
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|SENT|FINALIZED — defaults to DRAFT
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 *   - `warehouse`           string|null        — warehouse reference
 */
class UpdateCreditNoteRequest extends WafeqFormRequest
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

            'credit_note_date' => ['required', 'date_format:Y-m-d'],

            'credit_note_number' => ['required', 'string'],

            'currency' => ['required', 'string'],

            'custom_fields' => ['nullable', 'array'],

            'discount_cost_center' => ['nullable', 'string'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'language' => ['nullable', 'string', 'in:ar,en'],

            'line_items' => ['required', 'array'],

            'notes' => ['nullable', 'string'],

            'place_of_supply' => ['nullable', 'string'],

            'project' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,FINALIZED'],

            'tax_amount_type' => ['nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

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
            'credit_note_date' => 'credit note date',
            'credit_note_number' => 'credit note number',
            'currency' => 'currency',
            'custom_fields' => 'custom fields',
            'discount_cost_center' => 'discount cost center',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
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
        return CreditNoteData::class;
    }
}
