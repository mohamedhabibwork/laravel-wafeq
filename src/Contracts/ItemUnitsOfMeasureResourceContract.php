<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ItemUnitsOfMeasureResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ItemUnitsOfMeasureResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ItemUnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ItemUnitOfMeasureData;

    public function retrieve(string $id): ItemUnitOfMeasureData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ItemUnitOfMeasureData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ItemUnitOfMeasureData;

    public function destroy(string $id): bool;
}
