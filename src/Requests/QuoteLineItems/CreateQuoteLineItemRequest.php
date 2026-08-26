<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\QuoteLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /quotes/{quote_id}/line-items/`
 * — Create quote line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/quotes_line_items_create.md`.
 *
 * The endpoint's request body shape (`EstimateLineItem` schema, read-write fields):
 *
 *   - `cost_center`          string            — cost-center reference
 *   - `custom_fields`        object            — custom field values
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
 *
 * Note: Unlike `InvoiceLineItem`, the `account` field is **not**
 * part of the `EstimateLineItem` `required` array in the OpenAPI
 * schema and is therefore intentionally not validated here either.
 */
class CreateQuoteLineItemRequest extends WafeqFormRequest
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
            // Cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Custom field values keyed by field id.
            'custom_fields' => ['sometimes', 'array'],

            // Human description shown on the quote.
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
            'cost_center' => 'cost center',
            'custom_fields' => 'custom fields',
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
        return QuoteLineItemData::class;
    }
}
