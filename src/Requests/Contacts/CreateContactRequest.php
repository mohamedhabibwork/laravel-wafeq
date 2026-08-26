<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /contacts/` — Create contact.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/contacts_create.md`. The OpenAPI `api-v1-external-contact-read-write`
 * schema's `required` array lists the **only** client-sent field as `name`;
 * everything else (`address`, `phone`, `email`, etc.) carries server-side
 * defaults and is therefore nullable on create.
 */
class CreateContactRequest extends WafeqFormRequest
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
            // Optional address fields, all default to "" on the server.
            'additional_number' => ['nullable', 'string'],

            // Street address of the contact (default "").
            'address' => ['nullable', 'string'],

            // Ids of attached files / documents.
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            // Building number (4 digits for KSA addresses).
            'building_number' => ['nullable', 'string'],

            // City (default "").
            'city' => ['nullable', 'string'],

            // Unique contact code (default "").
            'code' => ['nullable', 'string'],

            // Array of company-identification records.
            'company_identification' => ['sometimes', 'array'],
            'company_identification.*' => ['array'],
            'company_identification.*.type' => ['required_with:company_identification', 'string', 'in:CRN,GCC,IQA,MLS,SAG,MOM,NAT,700,OTH,PAS,TIN,TRD'],
            'company_identification.*.value' => ['required_with:company_identification', 'string'],

            // ISO 3166 two-letter country code (full enum enforced via the DTO).
            'country' => ['nullable', 'string'],

            // Optional custom-fields payload.
            'custom_fields' => ['sometimes', 'array'],

            // District / neighbourhood (default "").
            'district' => ['nullable', 'string'],

            // Primary email (default "").
            'email' => ['nullable', 'string', 'email'],

            // Caller-managed identifier (maxLength: 255).
            'external_id' => ['nullable', 'string', 'max:255'],

            // Full name or business name of the contact — the only required field.
            'name' => ['required', 'string'],

            // Primary phone (default "").
            'phone' => ['nullable', 'string'],

            // Postal / ZIP code (default "").
            'postal_code' => ['nullable', 'string'],

            // Relationship tags (Customer, Supplier, Investor, Partner, Other).
            'relationship' => ['sometimes', 'array'],
            'relationship.*' => ['string'],

            // Tax registration number (default "").
            'tax_registration_number' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'additional_number' => 'additional number',
            'address' => 'address',
            'attachments' => 'attachments',
            'building_number' => 'building number',
            'city' => 'city',
            'code' => 'code',
            'company_identification' => 'company identification',
            'country' => 'country',
            'custom_fields' => 'custom fields',
            'district' => 'district',
            'email' => 'email',
            'external_id' => 'external id',
            'name' => 'name',
            'phone' => 'phone',
            'postal_code' => 'postal code',
            'relationship' => 'relationship',
            'tax_registration_number' => 'tax registration number',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ContactData::class;
    }
}
