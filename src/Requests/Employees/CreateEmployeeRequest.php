<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /employees/` — Create employee.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/employees_create.md`. The OpenAPI `required` array
 * for `Employee` includes only server-managed fields (`created_ts`,
 * `id`, `legacy_id`, `modified_ts`, `reimbursements_account`) plus
 * `name`. All client-sent fields except `name` are therefore nullable.
 */
class CreateEmployeeRequest extends WafeqFormRequest
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
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'date_hired' => ['nullable', 'date_format:Y-m-d'],
            'email' => ['nullable', 'string', 'email'],
            'name' => ['required', 'string'],
            'user' => ['nullable', 'string'],
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
