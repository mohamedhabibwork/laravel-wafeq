<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BillsLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BillsLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillLineItemData;

    public function retrieve(string $id): BillLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BillLineItemData;

    public function retrieveModel(): BillLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BillLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BillLineItemData;

    public function destroyModel(): bool;
}
