<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /invoices/{id}/tax-authority/report/`
 * — Report invoice to tax authority.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/invoices_tax_authority_report_create.md`.
 *
 * The endpoint has **no request body** — the only input is the
 * `{id}` path parameter. The schema declares the response shape
 * (`api-v1-invoice-tax-authority` with `metadata`, `reported_ts`,
 * `status`) which is read-only from the client's perspective.
 *
 * Because there is nothing to validate, this FormRequest exposes an
 * empty `rules()` array but still materialises an
 * {@see InvoiceData} from any payload that might be attached (e.g.
 * in tests).
 */
class CreateInvoiceTaxAuthorityReportRequest extends WafeqFormRequest
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
        return InvoiceData::class;
    }
}
