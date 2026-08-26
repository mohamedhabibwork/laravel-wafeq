<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /purchase-orders/{id}/` — Partial update purchase order.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/purchase_orders_partial_update.md`. The `PatchedPurchaseOrder`
 * schema defines no `required` array, so every field is treated as
 * optional — clients only send the keys they want to mutate.
 *
 * The endpoint's request body shape (read-write fields, all optional):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             string|null        — vendor contact reference
 *   - `currency`            string             — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id
 *   - `language`            enum ar|en         — printable document language
 *   - `line_items`          array              — purchase order line items
 *   - `notes`               string|null        — free-form notes
 *   - `project`             string|null        — project reference
 *   - `purchase_order_date` string|null date   — order date (yyyy-mm-dd)
 *   - `purchase_order_number` string|null      — unique order number
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|SENT|BILLED|VOIDED
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 *   - `terms`               string|null        — payment terms
 *
 * Server-managed (`readOnly`) properties (`id`, `amount`, `tax_amount`,
 * `created_ts`, `modified_ts`, `legacy_id`) are intentionally **not**
 * validated — they are returned by the API and must never be
 * client-sent.
 */
class PartialUpdatePurchaseOrderRequest extends WafeqFormRequest
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
            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['string'],

            'branch' => ['sometimes', 'nullable', 'string'],

            'contact' => ['sometimes', 'nullable', 'string'],

            'currency' => ['sometimes', 'string'],

            'custom_fields' => ['sometimes', 'nullable', 'array'],

            'exchange_rate' => ['sometimes', 'nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'language' => ['sometimes', 'nullable', 'string', 'in:ar,en'],

            'line_items' => ['sometimes', 'array'],

            'notes' => ['sometimes', 'nullable', 'string'],

            'project' => ['sometimes', 'nullable', 'string'],

            'purchase_order_date' => ['sometimes', 'nullable', 'date_format:Y-m-d'],

            'purchase_order_number' => ['sometimes', 'nullable', 'string'],

            'reference' => ['sometimes', 'nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,BILLED,VOIDED'],

            'tax_amount_type' => ['sometimes', 'nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            'terms' => ['sometimes', 'nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'attachments' => 'attachments',
            'branch' => 'branch',
            'contact' => 'contact',
            'currency' => 'currency',
            'custom_fields' => 'custom fields',
            'exchange_rate' => 'exchange rate',
            'external_id' => 'external id',
            'language' => 'language',
            'line_items' => 'line items',
            'notes' => 'notes',
            'project' => 'project',
            'purchase_order_date' => 'purchase order date',
            'purchase_order_number' => 'purchase order number',
            'reference' => 'reference',
            'status' => 'status',
            'tax_amount_type' => 'tax amount type',
            'terms' => 'terms',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PurchaseOrderData::class;
    }
}
