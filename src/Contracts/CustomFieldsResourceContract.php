<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * CustomFieldsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface CustomFieldsResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): CustomFieldData;

    public function retrieveModel(): CustomFieldData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): CustomFieldData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): CustomFieldData;

    public function destroyModel(): bool;
}
