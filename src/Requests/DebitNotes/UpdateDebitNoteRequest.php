<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /debit-notes/{id}/` — Update debit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/debit_notes_update.md`. Server-managed (`readOnly`)
 * fields (`id`, `amount`, `balance`, `tax_amount`, `created_ts`,
 * `modified_ts`, `legacy_id`) are filtered out and are not validated
 * here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             required string    — vendor contact reference
 *   - `currency`            required string    — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `debit_note_date`     required date      — issue date (yyyy-mm-dd)
 *   - `debit_note_number`   required string    — unique debit-note number
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id (default "")
 *   - `line_items`          required array     — debit-note line items
 *   - `notes`               string|null        — free-form notes
 *   - `order_number`        string(100)        — associated order number
 *   - `project`             string|null        — project reference
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|POSTED  — defaults to DRAFT
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 */
class UpdateDebitNoteRequest extends WafeqFormRequest
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

            'custom_fields' => ['nullable', 'array'],

            'debit_note_date' => ['required', 'date_format:Y-m-d'],

            'debit_note_number' => ['required', 'string'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'line_items' => ['required', 'array'],

            'notes' => ['nullable', 'string'],

            'order_number' => ['nullable', 'string', 'max:100'],

            'project' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,POSTED'],

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
