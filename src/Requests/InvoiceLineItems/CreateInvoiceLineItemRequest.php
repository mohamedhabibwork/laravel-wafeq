<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\InvoiceLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /invoices/{invoice_id}/line-items/`
 * — Create invoice line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/invoices_line_items_create.md`.
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
class CreateInvoiceLineItemRequest extends WafeqFormRequest
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
            // Account the line posts to.
            'account' => ['required', 'string'],

            // Cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Custom field values keyed by field id.
            'custom_fields' => ['sometimes', 'array'],

            // Human description shown on the invoice.
            'description' => ['required', 'string'],

            // Discount percentage (0..100).
            'discount' => ['nullable', 'numeric'],

            // Reference to the underlying product/service item.
            'item' => ['nullable', 'string'],

            // Unit-of-measure reference for the item.
            'item_unit_of_measure' => ['nullable', 'string'],

            // Insertion order (writeOnly).
            'order' => ['nullable', 'integer'],

            // Quantity supplied.
            'quantity' => ['required', 'numeric'],

            // Optional revenue recognition configuration.
            'revenue_recognition' => ['nullable', 'array'],

            // Tax-rate reference.
            'tax_rate' => ['nullable', 'string'],

            // Per-unit price.
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
