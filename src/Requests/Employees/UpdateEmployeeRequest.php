<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /employees/{id}/` — Update employee.
 *
 * Same `required` array as {@see CreateEmployeeRequest}: only `name`.
 */
class UpdateEmployeeRequest extends WafeqFormRequest
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
