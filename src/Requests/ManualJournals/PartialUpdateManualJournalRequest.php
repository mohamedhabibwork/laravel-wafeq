<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /manual-journals/{id}/` — Partial update manual journal.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/manual_journals_partial_update.md`. The
 * `PatchedManualJournal` schema defines no `required` array, so every
 * field is treated as optional — clients only send the keys they want
 * to mutate.
 *
 * The endpoint's request body shape mirrors {@see CreateManualJournalRequest};
 * see that class for the field-by-field description. All fields here use
 * `sometimes` so an empty payload is valid.
 */
class PartialUpdateManualJournalRequest extends WafeqFormRequest
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

            'date' => ['sometimes', 'date_format:Y-m-d'],

            'external_id' => ['sometimes', 'string', 'max:255'],

            'line_items' => ['sometimes', 'array'],

            'notes' => ['sometimes', 'string'],

            'reference' => ['sometimes', 'string'],

            'tax_amount_type' => ['sometimes', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'attachments' => 'attachments',
            'date' => 'date',
            'external_id' => 'external id',
            'line_items' => 'line items',
            'notes' => 'notes',
            'reference' => 'reference',
            'tax_amount_type' => 'tax amount type',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ManualJournalData::class;
    }
}
