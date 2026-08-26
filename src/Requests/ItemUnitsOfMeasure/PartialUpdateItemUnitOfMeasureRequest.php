<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /item-units-of-measure/{id}/` — Partial update item unit of measure.
 *
 * The PATCH body uses the `PatchedItemUnitOfMeasure` schema (no
 * `required` array) — every field becomes `sometimes`.
 */
class PartialUpdateItemUnitOfMeasureRequest extends WafeqFormRequest
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
            'conversion_factor' => ['sometimes', 'nullable', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
            'is_base' => ['sometimes', 'boolean'],
            'is_default_purchase' => ['sometimes', 'boolean'],
            'is_default_sales' => ['sometimes', 'boolean'],
            'item' => ['sometimes', 'nullable', 'string'],
            'unit_cost' => ['sometimes', 'nullable', 'numeric'],
            'unit_of_measure' => ['sometimes', 'nullable', 'string'],
            'unit_price' => ['sometimes', 'nullable', 'numeric'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'conversion_factor' => 'conversion factor',
            'is_active' => 'is active',
            'is_base' => 'is base',
            'is_default_purchase' => 'is default purchase',
            'is_default_sales' => 'is default sales',
            'item' => 'item',
            'unit_cost' => 'unit cost',
            'unit_of_measure' => 'unit of measure',
            'unit_price' => 'unit price',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ItemUnitOfMeasureData::class;
    }
}
