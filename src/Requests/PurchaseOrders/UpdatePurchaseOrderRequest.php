<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PUT /purchase-orders/{id}/` — Update purchase order.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/purchase_orders_update.md`. Server-managed (`readOnly`)
 * fields (`id`, `amount`, `tax_amount`, `created_ts`, `modified_ts`,
 * `legacy_id`) are filtered out and are not validated here.
 *
 * The endpoint's request body shape (read-write fields):
 *
 *   - `attachments`         array<string>      — file/document ids
 *   - `branch`              string|null        — branch reference
 *   - `contact`             string|null        — vendor contact reference
 *   - `currency`            required string    — ISO-4217 currency code
 *   - `custom_fields`       object             — custom field id → value
 *   - `exchange_rate`       number|null        — FX to base currency
 *   - `external_id`         string(255)        — caller-provided id (default "")
 *   - `language`            enum ar|en         — printable document language
 *   - `line_items`          required array     — purchase order line items
 *   - `notes`               string|null        — free-form notes
 *   - `project`             string|null        — project reference
 *   - `purchase_order_date` string|null date   — order date (yyyy-mm-dd)
 *   - `purchase_order_number` string|null      — unique order number
 *   - `reference`           string|null        — internal reference code
 *   - `status`              enum DRAFT|SENT|BILLED|VOIDED — defaults to DRAFT
 *   - `tax_amount_type`     enum TAX_INCLUSIVE|TAX_EXCLUSIVE
 *   - `terms`               string|null        — payment terms
 */
class UpdatePurchaseOrderRequest extends WafeqFormRequest
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

            'branch' => ['nullable', 'string'],

            'contact' => ['nullable', 'string'],

            'currency' => ['required', 'string'],

            'custom_fields' => ['nullable', 'array'],

            'exchange_rate' => ['nullable', 'numeric'],

            'external_id' => ['sometimes', 'nullable', 'string', 'max:255'],

            'language' => ['nullable', 'string', 'in:ar,en'],

            'line_items' => ['required', 'array'],

            'notes' => ['nullable', 'string'],

            'project' => ['nullable', 'string'],

            'purchase_order_date' => ['nullable', 'date_format:Y-m-d'],

            'purchase_order_number' => ['nullable', 'string'],

            'reference' => ['nullable', 'string'],

            'status' => ['sometimes', 'string', 'in:DRAFT,SENT,BILLED,VOIDED'],

            'tax_amount_type' => ['nullable', 'string', 'in:TAX_INCLUSIVE,TAX_EXCLUSIVE'],

            'terms' => ['nullable', 'string'],
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
