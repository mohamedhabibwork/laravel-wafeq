<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /warehouses/` — Create warehouse.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/warehouses_create.md`. The `Warehouse.required` array
 * lists server-managed fields (`created_ts`, `id`, `legacy_id`,
 * `modified_ts`, `state`) plus client-sent `account`, `address`,
 * `building_number`, `city`, `code`, `district`, `name`, `phone`,
 * `postal_code`.
 *
 * Localised fields (`address`, `city`, `district`, `name`) use the
 * Wafeq `{en, ar}` object — handled by `DualLangCast` on the DTO.
 */
class CreateWarehouseRequest extends WafeqFormRequest
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
            // Account associated with this warehouse.
            'account' => ['required', 'string'],

            // Full address in both languages.
            'address' => ['required', 'array'],
            'address.en' => ['required', 'string'],
            'address.ar' => ['nullable', 'string'],

            // Building number / identifier.
            'building_number' => ['required', 'string'],

            // City in both languages.
            'city' => ['required', 'array'],
            'city.en' => ['required', 'string'],
            'city.ar' => ['nullable', 'string'],

            // Unique code identifier.
            'code' => ['required', 'string'],

            // District in both languages.
            'district' => ['required', 'array'],
            'district.en' => ['required', 'string'],
            'district.ar' => ['nullable', 'string'],

            // Defaults to true on the server when omitted.
            'is_active' => ['sometimes', 'boolean'],

            // Warehouse name in both languages.
            'name' => ['required', 'array'],
            'name.en' => ['required', 'string'],
            'name.ar' => ['nullable', 'string'],

            // Contact phone.
            'phone' => ['required', 'string'],

            // Postal / ZIP code.
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
