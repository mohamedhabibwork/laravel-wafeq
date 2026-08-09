<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * BillsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BillsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillData;

    public function retrieve(string $id): BillData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BillData;

    public function retrieveModel(): BillData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BillData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BillData;

    public function destroyModel(): bool;
}
