<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /branches/` — Create branch.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/branches_create.md`. The request body shape (read-write fields):
 *
 *   - `address`           required object    — full address in both languages
 *   - `building_number`   required string    — building identifier
 *   - `city`              required object    — city in both languages
 *   - `district`          required object    — district in both languages
 *   - `is_active`         boolean (default true)
 *   - `name`              required object    — name in both languages
 *   - `phone`             required string    — contact phone
 *   - `postal_code`       required string    — postal/ZIP code
 *
 * Server-managed (`readOnly`) properties (`id`, `state`, `legacy_id`) are
 * intentionally not validated — they are returned by the API and must
 * never be client-sent.
 *
 * Localised fields (`address`, `city`, `district`, `name`) are wrapped in
 * the Wafeq `{en, ar}` object — handled by the `DualLangCast` on the DTO.
 */
class CreateBranchRequest extends WafeqFormRequest
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
            // Full address in both primary and secondary languages.
            'address' => ['required', 'array'],
            'address.en' => ['required', 'string'],
            'address.ar' => ['nullable', 'string'],

            // Building number / identifier of the branch location.
            'building_number' => ['required', 'string'],

            // City in both languages.
            'city' => ['required', 'array'],
            'city.en' => ['required', 'string'],
            'city.ar' => ['nullable', 'string'],

            // District / area in both languages.
            'district' => ['required', 'array'],
            'district.en' => ['required', 'string'],
            'district.ar' => ['nullable', 'string'],

            // Defaults to true on the server when omitted.
            'is_active' => ['sometimes', 'boolean'],

            // Name of the branch in both languages.
            'name' => ['required', 'array'],
            'name.en' => ['required', 'string'],
            'name.ar' => ['nullable', 'string'],

            // Contact phone for the branch.
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
