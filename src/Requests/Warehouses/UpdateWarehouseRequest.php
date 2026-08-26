<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /warehouses/{id}/` — Update warehouse.
 *
 * Same `required` array as {@see CreateWarehouseRequest}: `account`,
 * `address`, `building_number`, `city`, `code`, `district`, `name`,
 * `phone`, `postal_code` are all required.
 */
class UpdateWarehouseRequest extends WafeqFormRequest
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
            'account' => ['required', 'string'],

            'address' => ['required', 'array'],
            'address.en' => ['required', 'string'],
            'address.ar' => ['nullable', 'string'],

            'building_number' => ['required', 'string'],

            'city' => ['required', 'array'],
            'city.en' => ['required', 'string'],
            'city.ar' => ['nullable', 'string'],

            'code' => ['required', 'string'],

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
