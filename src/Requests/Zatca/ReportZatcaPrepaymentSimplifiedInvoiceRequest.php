<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/prepayment-simplified-invoices/report/` — report a simplified (B2C) prepayment invoice.
 *
 * The same body is accepted by `validate/` and `issue/`.
 * Rules derived from `prepayment_simplified_invoices_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaPrepaymentSimplifiedInvoiceRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::PrepaymentSimplifiedInvoice;
    }
}
