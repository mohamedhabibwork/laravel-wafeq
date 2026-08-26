<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /branches/{id}/` — Partial update branch.
 *
 * The PATCH body matches the `PatchedBranch` schema in
 * `wafeq-docs/branches_partial_update.md`. The Patched schema has
 * **no** required array — every field becomes `sometimes` so partial
 * updates are accepted.
 */
class PartialUpdateBranchRequest extends WafeqFormRequest
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
            'address' => ['sometimes', 'array'],
            'address.en' => ['required_with:address', 'string'],
            'address.ar' => ['nullable', 'string'],

            'building_number' => ['sometimes', 'nullable', 'string'],

            'city' => ['sometimes', 'array'],
            'city.en' => ['required_with:city', 'string'],
            'city.ar' => ['nullable', 'string'],

            'district' => ['sometimes', 'array'],
            'district.en' => ['required_with:district', 'string'],
            'district.ar' => ['nullable', 'string'],

            'is_active' => ['sometimes', 'boolean'],

            'name' => ['sometimes', 'array'],
            'name.en' => ['required_with:name', 'string'],
            'name.ar' => ['nullable', 'string'],

            'phone' => ['sometimes', 'nullable', 'string'],

            'postal_code' => ['sometimes', 'nullable', 'string'],
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
