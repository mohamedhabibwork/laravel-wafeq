<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /contacts/{id}/` — Update contact.
 *
 * Same `required` array as {@see CreateContactRequest}: only `name` is
 * required. All other fields default to "" when omitted.
 */
class UpdateContactRequest extends WafeqFormRequest
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
            'additional_number' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],
            'building_number' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'code' => ['nullable', 'string'],
            'company_identification' => ['sometimes', 'array'],
            'company_identification.*' => ['array'],
            'company_identification.*.type' => ['required_with:company_identification', 'string', 'in:CRN,GCC,IQA,MLS,SAG,MOM,NAT,700,OTH,PAS,TIN,TRD'],
            'company_identification.*.value' => ['required_with:company_identification', 'string'],
            'country' => ['nullable', 'string'],
            'custom_fields' => ['sometimes', 'array'],
            'district' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'email'],
            'external_id' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
            'relationship' => ['sometimes', 'array'],
            'relationship.*' => ['string'],
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
