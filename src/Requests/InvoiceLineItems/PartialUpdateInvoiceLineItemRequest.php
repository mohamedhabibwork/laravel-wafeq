<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\InvoiceLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /invoices/{invoice_id}/line-items/{id}/`
 * — Partial update invoice line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/invoices_line_items_partial_update.md`. The schema is
 * identical to {@see CreateInvoiceLineItemRequest}; partial updates
 * are flagged by PATCH and the server treats absent fields as no-ops.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`              required string   — chart-of-accounts id
 *   - `cost_center`          string            — cost-center reference
 *   - `custom_fields`        object            — custom field values
 *   - `description`          required string   — line description
 *   - `discount`             number|null       — discount percentage
 *   - `item`                 string            — product/service reference
 *   - `item_unit_of_measure` string|null       — uom reference
 *   - `order`                integer (writeOnly)
 *   - `quantity`             required number   — quantity
 *   - `revenue_recognition`  object|null       — revenue recognition
 *   - `tax_rate`             string            — tax-rate reference
 *   - `unit_amount`          required number   — unit price
 *
 * Server-managed (`readOnly`) properties such as `id`, `line_amount`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`,
 * `revenue_recognition_id` are intentionally **not** validated.
 */
class PartialUpdateInvoiceLineItemRequest extends WafeqFormRequest
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
        return [
            'account' => ['required', 'string'],

            'cost_center' => ['nullable', 'string'],

            'custom_fields' => ['sometimes', 'array'],

            'description' => ['required', 'string'],

            'discount' => ['nullable', 'numeric'],

            'item' => ['nullable', 'string'],

            'item_unit_of_measure' => ['nullable', 'string'],

            'order' => ['nullable', 'integer'],

            'quantity' => ['required', 'numeric'],

            'revenue_recognition' => ['nullable', 'array'],

            'tax_rate' => ['nullable', 'string'],

            'unit_amount' => ['required', 'numeric'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'account' => 'account',
            'cost_center' => 'cost center',
            'custom_fields' => 'custom fields',
            'description' => 'description',
            'discount' => 'discount',
            'item' => 'item',
            'item_unit_of_measure' => 'item unit of measure',
            'order' => 'order',
            'quantity' => 'quantity',
            'revenue_recognition' => 'revenue recognition',
            'tax_rate' => 'tax rate',
            'unit_amount' => 'unit amount',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return InvoiceLineItemData::class;
    }
}
