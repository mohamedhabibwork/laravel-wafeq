<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;

/**
 * UnitsOfMeasureResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface UnitsOfMeasureResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<UnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): UnitOfMeasureData;

    public function retrieve(string $id): UnitOfMeasureData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): UnitOfMeasureData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): UnitOfMeasureData;

    public function destroy(string $id): bool;
}
