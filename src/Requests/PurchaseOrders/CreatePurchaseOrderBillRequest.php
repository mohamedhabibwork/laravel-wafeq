<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /purchase-orders/{id}/bill/` — Convert purchase order to bill.
 *
 * The endpoint takes only the path-parameter `id` and has no request
 * body. The OpenAPI spec in `wafeq-docs/purchase_orders_bill_create.md`
 * defines no `requestBody` block, so this FormRequest intentionally
 * ships an empty `rules()` array. The `PurchaseOrderData` DTO is
 * returned (the response carries the new `Bill` envelope, which the
 * caller can hydrate separately).
 */
class CreatePurchaseOrderBillRequest extends WafeqFormRequest
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
        return [];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return PurchaseOrderData::class;
    }
}
