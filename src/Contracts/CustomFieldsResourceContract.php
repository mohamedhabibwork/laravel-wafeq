<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * CustomFieldsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface CustomFieldsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CustomFieldData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CustomFieldData;

    public function retrieve(string $id): CustomFieldData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CustomFieldData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CustomFieldData;

    public function destroy(string $id): bool;
}
