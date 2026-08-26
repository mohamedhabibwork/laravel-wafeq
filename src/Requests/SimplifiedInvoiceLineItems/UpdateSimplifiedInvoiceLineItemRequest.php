<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\SimplifiedInvoiceLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /simplified-invoices/{invoice_id}/line-items/{id}/`
 * — Update simplified invoice line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/simplified_invoices_line_items_update.md`. The body
 * shape is identical to {@see CreateSimplifiedInvoiceLineItemRequest};
 * the operation is differentiated only by HTTP verb and the `{id}`
 * path parameter.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`              required string   — chart-of-accounts id
 *   - `cost_center`          string            — cost-center reference
 *   - `description`          required string   — line description
 *   - `discount`             number|null       — discount percentage
 *   - `item`                 string            — product/service reference
 *   - `item_unit_of_measure` string|null       — uom reference
 *   - `order`                integer (writeOnly)
 *   - `quantity`             required number   — quantity
 *   - `tax_rate`             string            — tax-rate reference
 *   - `unit_amount`          required number   — unit price
 *
 * Server-managed (`readOnly`) properties such as `id`, `line_amount`,
 * `tax_amount`, `created_ts`, `modified_ts`, `legacy_id` are
 * intentionally **not** validated.
 */
class UpdateSimplifiedInvoiceLineItemRequest extends WafeqFormRequest
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

            'description' => ['required', 'string'],

            'discount' => ['nullable', 'numeric'],

            'item' => ['nullable', 'string'],

            'item_unit_of_measure' => ['nullable', 'string'],

            'order' => ['nullable', 'integer'],

            'quantity' => ['required', 'numeric'],

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
            'description' => 'description',
            'discount' => 'discount',
            'item' => 'item',
            'item_unit_of_measure' => 'item unit of measure',
            'order' => 'order',
            'quantity' => 'quantity',
            'tax_rate' => 'tax rate',
            'unit_amount' => 'unit amount',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return SimplifiedInvoiceLineItemData::class;
    }
}
