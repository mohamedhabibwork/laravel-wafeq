<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /cost-centers/{id}/` — Partial update cost center.
 *
 * The PATCH body uses the `PatchedCostCenter` schema (no `required`
 * array) — every field becomes `sometimes`.
 */
class PartialUpdateCostCenterRequest extends WafeqFormRequest
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
            'name_ar' => ['sometimes', 'nullable', 'string', 'max:200'],
            'name_en' => ['sometimes', 'nullable', 'string', 'max:200'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name_ar' => 'name (Arabic)',
            'name_en' => 'name (English)',
            'is_active' => 'is active',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return CostCenterData::class;
    }
}
