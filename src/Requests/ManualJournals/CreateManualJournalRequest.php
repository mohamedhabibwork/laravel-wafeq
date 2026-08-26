<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /manual-journals/` — Create manual journal.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/manual_journals_create.md`. The schema's `required`
 * array only contains server-managed (`readOnly`) fields (`id`,
 * `created_ts`, `modified_ts`, `legacy_id`, `serial_number`) plus
 * `date`. After filtering out the read-only fields, only `date` is
 * required from the caller.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`     array<string>     — file/document ids
 *   - `date`            required date      — journal date
 *   - `external_id`     string(255)       — caller-provided id
 *   - `line_items`      array<object>     — debit / credit lines
 *   - `notes`           string            — free-form notes
 *   - `reference`       string            — reference code
 *   - `tax_amount_type` enum (TAX_EXCLUSIVE default)
 */
class CreateManualJournalRequest extends WafeqFormRequest
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
            // Ids of files / documents attached to this manual journal.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Date of the manual journal (ISO-8601 yyyy-mm-dd).
            'date' => ['required', 'date_format:Y-m-d'],

            // External (caller-managed) identifier for idempotency.
            'external_id' => ['nullable', 'string', 'max:255'],

            // Debit / credit line items.
            'line_items' => ['sometimes', 'array'],

            // Free-form notes shown on the journal.
            'notes' => ['nullable', 'string'],

            // Optional reference code.
            'reference' => ['nullable', 'string'],

            // TAX_EXCLUSIVE | TAX_INCLUSIVE — defaults to
            // TAX_EXCLUSIVE when omitted.
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
