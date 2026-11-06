<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/debit-notes/report/` — clear a standard (B2B) debit note.
 *
 * The same body is accepted by `validate/`.
 * Rules derived from `debit_notes_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaDebitNoteRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::DebitNote;
    }
}
