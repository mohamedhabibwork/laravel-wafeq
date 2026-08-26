<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /credit-notes/` — Create credit note.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/credit_notes_create.md`. Server-managed (`readOnly`)
 * fields (`id`, `amount`, `balance`, `tax_amount`, `created_ts`,
 * `modified_ts`, `legacy_id`) are filtered out and not validated here.
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
class CreateCreditNoteRequest extends WafeqFormRequest
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
            // Ids of files / documents attached to this credit note.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Optional branch association.
            'branch' => ['nullable', 'string'],

            // Customer contact reference (required).
            'contact' => ['required', 'string'],

            // Date the credit note was issued (yyyy-mm-dd).
            'credit_note_date' => ['required', 'date_format:Y-m-d'],

            // Unique identifier / number assigned to this credit note.
            'credit_note_number' => ['required', 'string'],

            // ISO-4217 currency code. Full enum is enforced via the
            // Currency enum cast on the DTO; this rule keeps the wire
            // value as a non-empty string.
            'currency' => ['required', 'string'],

            // Optional mapping of custom field ids to values.
            'custom_fields' => ['nullable', 'array'],

            // Optional discount cost-center reference.
            'discount_cost_center' => ['nullable', 'string'],

            // FX rate to the organisation's base currency at the
            // document date — null when not applicable.
            'exchange_rate' => ['nullable', 'numeric'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Printable document language (ar | en).
            'language' => ['nullable', 'string', 'in:ar,en'],

            // Credit-note line items.
            'line_items' => ['required', 'array'],

            // Free-form notes / comments.
            'notes' => ['nullable', 'string'],

            // Optional place of supply.
            'place_of_supply' => ['nullable', 'string'],

            // Optional project tagging.
            'project' => ['nullable', 'string'],

            // Optional internal reference.
            'reference' => ['nullable', 'string'],

            // Status — defaults to DRAFT.
            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,FINALIZED'],

            // TAX_INCLUSIVE | TAX_EXCLUSIVE.
            'tax_amount_type' => ['nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            // Optional warehouse reference.
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
