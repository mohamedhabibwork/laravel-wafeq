<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /custom-fields/{id}/` — Update custom field.
 *
 * Same `required` array as {@see CreateCustomFieldRequest}: only
 * `apply_to` and `config` are required.
 */
class UpdateCustomFieldRequest extends WafeqFormRequest
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
            'apply_to' => ['required', 'array'],
            'apply_to.*' => ['string', 'in:SALES,PURCHASES,CONTACTS'],

            'config' => ['required', 'array'],
            'config.field_type' => ['required', 'string', 'in:TEXT,LONG_TEXT,NUMBER,DATE,SELECT,LOOKUP,CALCULATED'],

            'is_active' => ['sometimes', 'boolean'],
            'is_line_item_field' => ['sometimes', 'boolean'],
            'is_visible' => ['sometimes', 'boolean'],

            'name' => ['sometimes', 'nullable', 'string', 'max:100'],
            'name_ar' => ['sometimes', 'nullable', 'string', 'max:100'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'apply_to' => 'apply to',
            'config' => 'config',
            'config.field_type' => 'config field type',
            'is_active' => 'is active',
            'is_line_item_field' => 'is line item field',
            'is_visible' => 'is visible',
            'name' => 'name',
            'name_ar' => 'name (Arabic)',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return CustomFieldData::class;
    }
}
