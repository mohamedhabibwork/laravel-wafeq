<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/prepayment-invoices/report/` — clear a standard (B2B) prepayment invoice.
 *
 * The same body is accepted by `validate/`.
 * Rules derived from `prepayment_invoices_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaPrepaymentInvoiceRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::PrepaymentInvoice;
    }
}
