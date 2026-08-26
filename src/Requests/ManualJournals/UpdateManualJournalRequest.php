<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /manual-journals/{id}/` — Update manual journal.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/manual_journals_update.md`. The schema's `required`
 * array only contains server-managed (`readOnly`) fields (`id`,
 * `created_ts`, `modified_ts`, `legacy_id`, `serial_number`) plus
 * `date`. After filtering out the read-only fields, only `date` is
 * required from the caller.
 *
 * The endpoint's request body shape mirrors {@see CreateManualJournalRequest};
 * see that class for the field-by-field description.
 */
class UpdateManualJournalRequest extends WafeqFormRequest
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

            'date' => ['required', 'date_format:Y-m-d'],

            'external_id' => ['nullable', 'string', 'max:255'],

            'line_items' => ['sometimes', 'array'],

            'notes' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],

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
