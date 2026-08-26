<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /item-units-of-measure/` — Create item unit of measure.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/item_units_of_measure_create.md`. The
 * `ItemUnitOfMeasure.required` array lists `conversion_factor` and
 * `unit_of_measure` as required (alongside server-managed
 * `created_ts`, `id`, `modified_ts`, `unit_of_measure_name` and the
 * caller-supplied `item`).
 *
 *   - `conversion_factor`  required number  — relative to base unit
 *   - `item`               required string  — owning item id
 *   - `unit_of_measure`    required string  — unit-of-measure id
 */
class CreateItemUnitOfMeasureRequest extends WafeqFormRequest
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
            'conversion_factor' => ['required', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
            'is_base' => ['sometimes', 'boolean'],
            'is_default_purchase' => ['sometimes', 'boolean'],
            'is_default_sales' => ['sometimes', 'boolean'],
            'item' => ['required', 'string'],
            'unit_cost' => ['nullable', 'numeric'],
            'unit_of_measure' => ['required', 'string'],
            'unit_price' => ['nullable', 'numeric'],
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
