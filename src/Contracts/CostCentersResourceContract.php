<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * CostCentersResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface CostCentersResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CostCenterData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CostCenterData;

    public function retrieve(string $id): CostCenterData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CostCenterData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CostCenterData;

    public function destroy(string $id): bool;
}
