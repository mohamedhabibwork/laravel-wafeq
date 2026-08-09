<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;

/**
 * PurchaseOrdersLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PurchaseOrdersLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderLineItemData;

    public function retrieve(string $id): PurchaseOrderLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): PurchaseOrderLineItemData;

    public function retrieveModel(): PurchaseOrderLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): PurchaseOrderLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): PurchaseOrderLineItemData;

    public function destroyModel(): bool;
}
