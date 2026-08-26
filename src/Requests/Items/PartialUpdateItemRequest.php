<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /items/{id}/` — Partial update item.
 *
 * The PATCH body uses the `PatchedItem` schema (no `required` array)
 * — every field becomes `sometimes`.
 */
class PartialUpdateItemRequest extends WafeqFormRequest
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
            'description' => ['sometimes', 'nullable', 'string'],
            'expense_account' => ['sometimes', 'nullable', 'string'],
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'is_tracked_inventory' => ['sometimes', 'boolean'],
            'item_units_of_measure' => ['sometimes', 'array'],
            'item_units_of_measure.*' => ['array'],
            'item_units_of_measure.*.conversion_factor' => ['required_with:item_units_of_measure', 'numeric'],
            'item_units_of_measure.*.is_active' => ['sometimes', 'boolean'],
            'item_units_of_measure.*.is_base' => ['sometimes', 'boolean'],
            'item_units_of_measure.*.is_default_purchase' => ['sometimes', 'boolean'],
            'item_units_of_measure.*.is_default_sales' => ['sometimes', 'boolean'],
            'item_units_of_measure.*.unit_cost' => ['sometimes', 'nullable', 'numeric'],
            'item_units_of_measure.*.unit_of_measure' => ['required_with:item_units_of_measure', 'string'],
            'item_units_of_measure.*.unit_price' => ['sometimes', 'nullable', 'numeric'],
            'name' => ['sometimes', 'nullable', 'string', 'max:200'],
            'purchase_tax_rate' => ['sometimes', 'nullable', 'string'],
            'revenue_account' => ['sometimes', 'nullable', 'string'],
            'revenue_tax_rate' => ['sometimes', 'nullable', 'string'],
            'sku' => ['sometimes', 'nullable', 'string', 'max:200'],
            'tax_authority' => ['sometimes', 'nullable', 'array'],
            'tax_authority.metadata' => ['sometimes', 'nullable', 'array'],
            'tax_authority.metadata.default_exemption_reason' => ['sometimes', 'nullable', 'string'],
            'unit_cost' => ['sometimes', 'nullable', 'numeric'],
            'unit_price' => ['sometimes', 'nullable', 'numeric'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'description' => 'description',
            'expense_account' => 'expense account',
            'external_id' => 'external id',
            'is_active' => 'is active',
            'is_tracked_inventory' => 'is tracked inventory',
            'item_units_of_measure' => 'item units of measure',
            'name' => 'name',
            'purchase_tax_rate' => 'purchase tax rate',
            'revenue_account' => 'revenue account',
            'revenue_tax_rate' => 'revenue tax rate',
            'sku' => 'SKU',
            'tax_authority' => 'tax authority',
            'unit_cost' => 'unit cost',
            'unit_price' => 'unit price',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ItemData::class;
    }
}
