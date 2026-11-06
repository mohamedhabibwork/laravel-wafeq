<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;

/**
 * FormRequest for `POST /zatca/invoices/report/` — clear a standard (B2B) invoice.
 *
 * The same body is accepted by `validate/`.
 * Rules derived from `invoices_report_create` in the Wafeq ZATCA reference.
 */
class ReportZatcaInvoiceRequest extends ZatcaDocumentFormRequest
{
    public function documentType(): ZatcaDocumentType
    {
        return ZatcaDocumentType::Invoice;
    }
}
