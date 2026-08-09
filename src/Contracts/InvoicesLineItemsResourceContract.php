<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * InvoicesLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface InvoicesLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceLineItemData;

    public function retrieve(string $id): InvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): InvoiceLineItemData;

    public function retrieveModel(): InvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): InvoiceLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): InvoiceLineItemData;

    public function destroyModel(): bool;
}
