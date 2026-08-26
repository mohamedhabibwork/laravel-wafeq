<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /credit-notes/{id}/tax-authority/report/` —
 * Report credit note to the tax authority.
 *
 * The endpoint takes only the path-parameter `id` and has no request
 * body. The OpenAPI spec in
 * `wafeq-docs/credit_notes_tax_authority_report_create.md` defines no
 * `requestBody` block, so this FormRequest intentionally ships an empty
 * `rules()` array. The `CreditNoteData` DTO is returned (the response
 * carries the tax-authority envelope, which the caller can hydrate
 * separately).
 */
class CreateCreditNoteTaxAuthorityReportRequest extends WafeqFormRequest
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
        return [];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return CreditNoteData::class;
    }
}
