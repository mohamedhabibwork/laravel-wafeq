<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * AccountsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface AccountsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AccountData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AccountData;

    public function retrieve(string $id): AccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AccountData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): AccountData;

    public function retrieveModel(): AccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): AccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): AccountData;

    public function destroyModel(): bool;
}
