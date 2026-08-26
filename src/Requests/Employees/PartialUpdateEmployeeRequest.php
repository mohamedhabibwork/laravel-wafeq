<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /employees/{id}/` — Partial update employee.
 *
 * The PATCH body uses the `PatchedEmployee` schema (no `required`
 * array) — every field becomes `sometimes`.
 */
class PartialUpdateEmployeeRequest extends WafeqFormRequest
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
            'address' => ['sometimes', 'nullable', 'string'],
            'city' => ['sometimes', 'nullable', 'string'],
            'country' => ['sometimes', 'nullable', 'string'],
            'date_hired' => ['sometimes', 'nullable', 'date_format:Y-m-d'],
            'email' => ['sometimes', 'nullable', 'string', 'email'],
            'name' => ['sometimes', 'nullable', 'string'],
            'user' => ['sometimes', 'nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'address' => 'address',
            'city' => 'city',
            'country' => 'country',
            'date_hired' => 'date hired',
            'email' => 'email',
            'name' => 'name',
            'user' => 'user',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return EmployeeData::class;
    }
}
