<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /debit-notes/{id}/` — Partial update debit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/debit_notes_partial_update.md`. The `PatchedDebitNote`
 * schema defines no `required` array, so every field is treated as
 * optional — clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape (read-write fields, all optional):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             string             — vendor contact reference
 *   - `currency`            string             — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `debit_note_date`     date               — issue date (yyyy-mm-dd)
 *   - `debit_note_number`   string             — unique debit-note number
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id
 *   - `line_items`          array              — debit-note line items
 *   - `notes`               string|null        — free-form notes
 *   - `order_number`        string(100)        — associated order number
 *   - `project`             string|null        — project reference
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|POSTED
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 *
 * Server-managed (`readOnly`) properties (`id`, `amount`, `balance`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`) are
 * intentionally **not** validated — they are returned by the API and
 * must never be client-sent.
 */
class PartialUpdateDebitNoteRequest extends WafeqFormRequest
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

            'currency' => ['sometimes', 'string'],

            'custom_fields' => ['sometimes', 'nullable', 'array'],

            'debit_note_date' => ['sometimes', 'date_format:Y-m-d'],

            'debit_note_number' => ['sometimes', 'string'],

            'exchange_rate' => ['sometimes', 'nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'line_items' => ['sometimes', 'array'],

            'notes' => ['sometimes', 'nullable', 'string'],

            'order_number' => ['sometimes', 'nullable', 'string', 'max:100'],

            'project' => ['sometimes', 'nullable', 'string'],

            'reference' => ['sometimes', 'nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,POSTED'],

            'tax_amount_type' => ['sometimes', 'nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],
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
            'debit_note_date' => 'debit note date',
            'debit_note_number' => 'debit note number',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
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
        return DebitNoteData::class;
    }
}
