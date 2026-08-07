<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ItemsResourceContract extends ResourceContract
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
}
