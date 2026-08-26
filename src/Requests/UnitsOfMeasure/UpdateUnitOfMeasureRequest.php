<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /units-of-measure/{id}/` — Update unit of measure.
 *
 * Same `required` array as {@see CreateUnitOfMeasureRequest}: only
 * `name` is required.
 */
class UpdateUnitOfMeasureRequest extends WafeqFormRequest
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
            'is_active' => ['sometimes', 'boolean'],
            'name' => ['required', 'string', 'max:200'],
            'name_ar' => ['nullable', 'string', 'max:200'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'is active',
            'name' => 'name',
            'name_ar' => 'name (Arabic)',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return UnitOfMeasureData::class;
    }
}
