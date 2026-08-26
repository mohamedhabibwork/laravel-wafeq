<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\BillLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /bills/{bill_id}/line-items/{id}/` — Partial update bill line item.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/bills_line_items_partial_update.md`. The `PatchedBillLineItem`
 * schema defines no `required` array, so every field is treated as
 * optional — clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape (read-write fields, all optional):
 *
 *   - `account`              string                  — chart-of-accounts id
 *   - `amortization`         writeOnly object        — embedded amortization config
 *   - `cost_center`          string|null             — cost-center reference
 *   - `custom_fields`        object                  — custom field id → value
 *   - `description`          string                  — line-item description
 *   - `discount`             number|null (min 0)     — discount percentage
 *   - `item`                 string|null             — item reference
 *   - `item_unit_of_measure` string|null             — UoM reference
 *   - `order`                integer                 — ordering hint (writeOnly)
 *   - `quantity`             number                  — quantity (positive)
 *   - `tax_rate`             string|null             — tax-rate reference
 *   - `unit_amount`          number                  — unit price
 *
 * Server-managed (`readOnly`) properties (`id`, `amortization_id`,
 * `line_amount`, `tax_amount`, `created_ts`, `modified_ts`, `legacy_id`)
 * are intentionally **not** validated — they are returned by the API
 * and must never be client-sent.
 */
class PartialUpdateBillLineItemRequest extends WafeqFormRequest
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
            'account' => ['sometimes', 'string'],

            'amortization' => ['sometimes', 'array'],

            'cost_center' => ['sometimes', 'nullable', 'string'],

            'custom_fields' => ['sometimes', 'nullable', 'array'],

            'description' => ['sometimes', 'string'],

            'discount' => ['sometimes', 'nullable', 'numeric', 'min:0'],

            'item' => ['sometimes', 'nullable', 'string'],

            'item_unit_of_measure' => ['sometimes', 'nullable', 'string'],

            'order' => ['sometimes', 'nullable', 'integer'],

            'quantity' => ['sometimes', 'numeric'],

            'tax_rate' => ['sometimes', 'nullable', 'string'],

            'unit_amount' => ['sometimes', 'numeric'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'account' => 'account',
            'amortization' => 'amortization',
            'cost_center' => 'cost center',
            'custom_fields' => 'custom fields',
            'description' => 'description',
            'discount' => 'discount',
            'item' => 'item',
            'item_unit_of_measure' => 'item unit of measure',
            'order' => 'order',
            'quantity' => 'quantity',
            'tax_rate' => 'tax rate',
            'unit_amount' => 'unit amount',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return BillLineItemData::class;
    }
}
