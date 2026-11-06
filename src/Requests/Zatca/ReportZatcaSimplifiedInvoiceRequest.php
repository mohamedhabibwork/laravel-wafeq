<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/simplified-invoices/report/` — report a simplified (B2C) invoice.
 *
 * The same body is accepted by `validate/` and `issue/`.
 * Rules derived from `simplified_invoices_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaSimplifiedInvoiceRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::SimplifiedInvoice;
    }
}
