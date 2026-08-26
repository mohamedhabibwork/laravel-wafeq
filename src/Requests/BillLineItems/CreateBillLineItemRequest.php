<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BillLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /bills/{bill_id}/line-items/` — Create bill line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bills_line_items_create.md`. Server-managed (`readOnly`)
 * fields (`id`, `amortization_id`, `line_amount`, `tax_amount`,
 * `created_ts`, `modified_ts`, `legacy_id`) are filtered out and not
 * validated here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `account`              required string         — chart-of-accounts id
 *   - `amortization`         writeOnly object        — embedded amortization config
 *   - `cost_center`          string|null             — cost-center reference
 *   - `custom_fields`        object                  — custom field id → value
 *   - `description`          required string         — line-item description
 *   - `discount`             number|null (min 0)     — discount percentage
 *   - `item`                 string|null             — item reference
 *   - `item_unit_of_measure` string|null             — UoM reference
 *   - `order`                integer                 — ordering hint (writeOnly)
 *   - `quantity`             required number         — quantity (positive)
 *   - `tax_rate`             string|null             — tax-rate reference
 *   - `unit_amount`          required number         — unit price
 */
class CreateBillLineItemRequest extends WafeqFormRequest
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
            // The expense / asset account the line posts to.
            'account' => ['required', 'string'],

            // Embedded amortization configuration (only honoured on create).
            'amortization' => ['sometimes', 'array'],

            // Optional cost-center tagging.
            'cost_center' => ['nullable', 'string'],

            // Optional mapping of custom field ids to values.
            'custom_fields' => ['nullable', 'array'],

            // Human-readable description of the line item.
            'description' => ['required', 'string'],

            // Optional discount, expressed as a percentage (>= 0).
            'discount' => ['nullable', 'numeric', 'min:0'],

            // Optional item reference.
            'item' => ['nullable', 'string'],

            // Optional item-unit-of-measure reference.
            'item_unit_of_measure' => ['nullable', 'string'],

            // Ordering hint — writeOnly.
            'order' => ['nullable', 'integer'],

            // Quantity of the item / service (required, positive).
            'quantity' => ['required', 'numeric'],

            // Optional tax-rate reference.
            'tax_rate' => ['nullable', 'string'],

            // Unit price (required).
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
            'amortization' => 'amortization',
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
        return BillLineItemData::class;
    }
}
