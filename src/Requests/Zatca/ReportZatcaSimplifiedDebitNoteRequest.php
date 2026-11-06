<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/simplified-debit-notes/report/` — report a simplified (B2C) debit note.
 *
 * The same body is accepted by `validate/` and `issue/`.
 * Rules derived from `simplified_debit_notes_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaSimplifiedDebitNoteRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::SimplifiedDebitNote;
    }
}
