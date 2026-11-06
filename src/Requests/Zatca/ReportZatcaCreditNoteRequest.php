<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/credit-notes/report/` — clear a standard (B2B) credit note.
 *
 * The same body is accepted by `validate/`.
 * Rules derived from `credit_notes_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaCreditNoteRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::CreditNote;
    }
}
