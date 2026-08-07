<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;

/**
 * SimplifiedInvoicesLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface SimplifiedInvoicesLineItemsResourceContract extends ResourceContract
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
}
