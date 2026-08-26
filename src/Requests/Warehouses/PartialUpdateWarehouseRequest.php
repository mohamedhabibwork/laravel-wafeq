<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /warehouses/{id}/` — Partial update warehouse.
 *
 * The PATCH body uses the `PatchedWarehouse` schema (no `required`
 * array) — every field becomes `sometimes`.
 */
class PartialUpdateWarehouseRequest extends WafeqFormRequest
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
            'account' => ['sometimes', 'nullable', 'string'],

            'address' => ['sometimes', 'array'],
            'address.en' => ['required_with:address', 'string'],
            'address.ar' => ['nullable', 'string'],

            'building_number' => ['sometimes', 'nullable', 'string'],

            'city' => ['sometimes', 'array'],
            'city.en' => ['required_with:city', 'string'],
            'city.ar' => ['nullable', 'string'],

            'code' => ['sometimes', 'nullable', 'string'],

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
            'account' => 'account',
            'address' => 'address',
            'address.en' => 'address (English)',
            'address.ar' => 'address (Arabic)',
            'building_number' => 'building number',
            'city' => 'city',
            'city.en' => 'city (English)',
            'city.ar' => 'city (Arabic)',
            'code' => 'code',
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
        return WarehouseData::class;
    }
}
