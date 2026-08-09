<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\WarehouseData;

/**
 * WarehousesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface WarehousesResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): WarehouseData;

    public function retrieveModel(): WarehouseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): WarehouseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): WarehouseData;

    public function destroyModel(): bool;
}
