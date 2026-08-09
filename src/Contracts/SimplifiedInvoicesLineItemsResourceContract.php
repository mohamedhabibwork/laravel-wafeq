<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;

/**
 * SimplifiedInvoicesLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface SimplifiedInvoicesLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<SimplifiedInvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): SimplifiedInvoiceLineItemData;

    public function retrieve(string $id): SimplifiedInvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): SimplifiedInvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): SimplifiedInvoiceLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): SimplifiedInvoiceLineItemData;

    public function retrieveModel(): SimplifiedInvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): SimplifiedInvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): SimplifiedInvoiceLineItemData;

    public function destroyModel(): bool;
}
