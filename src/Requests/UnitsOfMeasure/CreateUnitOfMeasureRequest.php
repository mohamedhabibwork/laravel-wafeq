<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /units-of-measure/` — Create unit of measure.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/units_of_measure_create.md`. The `UnitOfMeasure.required`
 * array lists `created_ts`, `id`, `modified_ts` (server-managed) and
 * `name`. `name_ar` is optional (max 200), `is_active` defaults to true.
 *
 *   - `name`      required string (max 200) — English name
 *   - `name_ar`   optional string (max 200) — Arabic name
 */
class CreateUnitOfMeasureRequest extends WafeqFormRequest
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
