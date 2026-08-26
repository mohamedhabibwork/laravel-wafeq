<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /quotes/{id}/invoice/`
 * — Convert quote to invoice.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/quotes_invoice_create.md`.
 *
 * The endpoint has **no request body** — the only input is the
 * `{id}` path parameter of the source quote. The server returns a
 * full `Invoice` shape (defined elsewhere in the package).
 *
 * Because there is nothing to validate, this FormRequest exposes an
 * empty `rules()` array but still materialises a {@see QuoteData}
 * from any payload that might be attached (e.g. in tests).
 */
class CreateQuoteInvoiceRequest extends WafeqFormRequest
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
        return QuoteData::class;
    }
}
