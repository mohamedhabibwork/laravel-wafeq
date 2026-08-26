<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /contacts/{id}/` — Partial update contact.
 *
 * The PATCH body uses the `Patchedapi-v1-external-contact-read-write`
 * schema (no `required` array) so every field is optional.
 */
class PartialUpdateContactRequest extends WafeqFormRequest
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
            'additional_number' => ['sometimes', 'nullable', 'string'],
            'address' => ['sometimes', 'nullable', 'string'],
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],
            'building_number' => ['sometimes', 'nullable', 'string'],
            'city' => ['sometimes', 'nullable', 'string'],
            'code' => ['sometimes', 'nullable', 'string'],
            'company_identification' => ['sometimes', 'array'],
            'company_identification.*' => ['array'],
            'company_identification.*.type' => ['required_with:company_identification', 'string', 'in:CRN,GCC,IQA,MLS,SAG,MOM,NAT,700,OTH,PAS,TIN,TRD'],
            'company_identification.*.value' => ['required_with:company_identification', 'string'],
            'country' => ['sometimes', 'nullable', 'string'],
            'custom_fields' => ['sometimes', 'array'],
            'district' => ['sometimes', 'nullable', 'string'],
            'email' => ['sometimes', 'nullable', 'string', 'email'],
            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],
            'name' => ['sometimes', 'nullable', 'string'],
            'phone' => ['sometimes', 'nullable', 'string'],
            'postal_code' => ['sometimes', 'nullable', 'string'],
            'relationship' => ['sometimes', 'array'],
            'relationship.*' => ['string'],
            'tax_registration_number' => ['sometimes', 'nullable', 'string'],
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
