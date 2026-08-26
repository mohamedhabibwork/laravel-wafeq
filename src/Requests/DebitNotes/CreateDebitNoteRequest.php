<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /debit-notes/` — Create debit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/debit_notes_create.md`. Server-managed (`readOnly`) fields
 * (`id`, `amount`, `balance`, `tax_amount`, `created_ts`, `modified_ts`,
 * `legacy_id`) are filtered out and not validated here.
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
class CreateDebitNoteRequest extends WafeqFormRequest
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
            // Ids of files / documents attached to this debit note.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // Vendor / customer contact (required).
            'contact' => ['required', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Optional mapping of custom field ids to values.
            'custom_fields' => ['nullable', 'array'],

            // Date the debit note was issued (yyyy-mm-dd).
            'debit_note_date' => ['required', 'date_format:Y-m-d'],

            // Unique identifier / number assigned to this debit note.
            'debit_note_number' => ['required', 'string'],

            // FX rate to the organisation's base currency at the
            // document date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Debit-note line items.
            'line_items' => ['required', 'array'],

            // Free-form notes / comments.
            'notes' => ['nullable', 'string'],

            // Associated order number (capped at 100 chars).
            'order_number' => ['nullable', 'string', 'max:100'],

            // Optional project tagging.
            'project' => ['nullable', 'string'],

            // Optional internal reference.
            'reference' => ['nullable', 'string'],

            // Status — defaults to DRAFT.
            'status' => ['sometimes', 'string', 'in:DRAFT,POSTED'],

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
