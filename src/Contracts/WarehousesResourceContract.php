<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\WarehouseData;

/**
 * WarehousesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface WarehousesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<WarehouseData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): WarehouseData;

    public function retrieve(string $id): WarehouseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): WarehouseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): WarehouseData;

    public function destroy(string $id): bool;
}
