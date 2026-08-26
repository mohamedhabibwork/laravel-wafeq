<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /cost-centers/{id}/` — Update cost center.
 *
 * Same `required` array as {@see CreateCostCenterRequest}: `name_ar`,
 * `name_en`, and `is_active` are all required.
 */
class UpdateCostCenterRequest extends WafeqFormRequest
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
            'name_ar' => ['required', 'string', 'max:200'],
            'name_en' => ['required', 'string', 'max:200'],
            'is_active' => ['required', 'boolean'],
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
