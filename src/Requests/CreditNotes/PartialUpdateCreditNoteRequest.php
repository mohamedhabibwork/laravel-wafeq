<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /credit-notes/{id}/` — Partial update credit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/credit_notes_partial_update.md`. The `PatchedCreditNote`
 * schema defines no `required` array, so every field is treated as
 * optional — clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape (read-write fields, all optional):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             string             — customer contact reference
 *   - `credit_note_date`    date               — issue date (yyyy-mm-dd)
 *   - `credit_note_number`  string             — unique credit-note number
 *   - `currency`            string             — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `discount_cost_center` string|null       — discount cost-center reference
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id
 *   - `language`            enum ar|en         — printable document language
 *   - `line_items`          array              — credit-note line items
 *   - `notes`               string|null        — free-form notes
 *   - `place_of_supply`     string|null        — place of supply
 *   - `project`             string|null        — project reference
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|SENT|FINALIZED
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 *   - `warehouse`           string|null        — warehouse reference
 *
 * Server-managed (`readOnly`) properties (`id`, `amount`, `balance`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`) are
 * intentionally **not** validated — they are returned by the API and
 * must never be client-sent.
 */
class PartialUpdateCreditNoteRequest extends WafeqFormRequest
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

            'branch' => ['sometimes', 'nullable', 'string'],

            'contact' => ['sometimes', 'string'],

            'credit_note_date' => ['sometimes', 'date_format:Y-m-d'],

            'credit_note_number' => ['sometimes', 'string'],

            'currency' => ['sometimes', 'string'],

            'custom_fields' => ['sometimes', 'nullable', 'array'],

            'discount_cost_center' => ['sometimes', 'nullable', 'string'],

            'exchange_rate' => ['sometimes', 'nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'language' => ['sometimes', 'nullable', 'string', 'in:ar,en'],

            'line_items' => ['sometimes', 'array'],

            'notes' => ['sometimes', 'nullable', 'string'],

            'place_of_supply' => ['sometimes', 'nullable', 'string'],

            'project' => ['sometimes', 'nullable', 'string'],

            'reference' => ['sometimes', 'nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,FINALIZED'],

            'tax_amount_type' => ['sometimes', 'nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            'warehouse' => ['sometimes', 'nullable', 'string'],
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
