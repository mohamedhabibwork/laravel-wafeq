<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /cost-centers/` — Create cost center.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/cost_centers_create.md`. The OpenAPI `required` array
 * lists `name_ar` and `name_en` as required; `is_active` is required
 * (no default) and `id` / `created_ts` / `modified_ts` / `legacy_id`
 * are read-only.
 *
 *   - `name_ar`     required string (max 200) — Arabic name
 *   - `name_en`     required string (max 200) — English name
 *   - `is_active`   required bool              — active flag
 */
class CreateCostCenterRequest extends WafeqFormRequest
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
