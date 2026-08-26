<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BillLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /bills/{bill_id}/line-items/{id}/` — Update bill line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bills_line_items_update.md`. Server-managed (`readOnly`)
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
class UpdateBillLineItemRequest extends WafeqFormRequest
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

            'amortization' => ['sometimes', 'array'],

            'cost_center' => ['nullable', 'string'],

            'custom_fields' => ['nullable', 'array'],

            'description' => ['required', 'string'],

            'discount' => ['nullable', 'numeric', 'min:0'],

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
