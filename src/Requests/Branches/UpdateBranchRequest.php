<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /branches/{id}/` — Update branch.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/branches_update.md`. Same read-write shape as
 * {@see CreateBranchRequest} — the OpenAPI required array for the
 * `Branch` schema is identical between the POST and PUT operations.
 */
class UpdateBranchRequest extends WafeqFormRequest
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
            'address' => ['required', 'array'],
            'address.en' => ['required', 'string'],
            'address.ar' => ['nullable', 'string'],

            'building_number' => ['required', 'string'],

            'city' => ['required', 'array'],
            'city.en' => ['required', 'string'],
            'city.ar' => ['nullable', 'string'],

            'district' => ['required', 'array'],
            'district.en' => ['required', 'string'],
            'district.ar' => ['nullable', 'string'],

            'is_active' => ['sometimes', 'boolean'],

            'name' => ['required', 'array'],
            'name.en' => ['required', 'string'],
            'name.ar' => ['nullable', 'string'],

            'phone' => ['required', 'string'],

            'postal_code' => ['required', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'address' => 'address',
            'address.en' => 'address (English)',
            'address.ar' => 'address (Arabic)',
            'building_number' => 'building number',
            'city' => 'city',
            'city.en' => 'city (English)',
            'city.ar' => 'city (Arabic)',
            'district' => 'district',
            'district.en' => 'district (English)',
            'district.ar' => 'district (Arabic)',
            'is_active' => 'is active',
            'name' => 'name',
            'name.en' => 'name (English)',
            'name.ar' => 'name (Arabic)',
            'phone' => 'phone',
            'postal_code' => 'postal code',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BranchData::class;
    }
}
