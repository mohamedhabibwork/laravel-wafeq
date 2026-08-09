<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteLineItemData;

/**
 * QuotesLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface QuotesLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteLineItemData;

    public function retrieve(string $id): QuoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): QuoteLineItemData;

    public function retrieveModel(): QuoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): QuoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): QuoteLineItemData;

    public function destroyModel(): bool;
}
