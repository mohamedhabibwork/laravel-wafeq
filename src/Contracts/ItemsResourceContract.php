<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ItemData;

    public function retrieve(string $id): ItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ItemData;

    public function retrieveModel(): ItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ItemData;

    public function destroyModel(): bool;
}
