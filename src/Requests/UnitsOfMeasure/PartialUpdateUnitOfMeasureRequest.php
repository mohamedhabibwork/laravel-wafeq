<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /units-of-measure/{id}/` — Partial update unit of measure.
 *
 * The PATCH body uses the `PatchedUnitOfMeasure` schema (no `required`
 * array) — every field becomes `sometimes`.
 */
class PartialUpdateUnitOfMeasureRequest extends WafeqFormRequest
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
            'name' => ['sometimes', 'nullable', 'string', 'max:200'],
            'name_ar' => ['sometimes', 'nullable', 'string', 'max:200'],
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
