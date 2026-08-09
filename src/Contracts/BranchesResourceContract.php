<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BranchesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BranchesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BranchData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BranchData;

    public function retrieve(string $id): BranchData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BranchData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BranchData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BranchData;

    public function retrieveModel(): BranchData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BranchData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BranchData;

    public function destroyModel(): bool;
}
