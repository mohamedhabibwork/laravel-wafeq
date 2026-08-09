<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BankAccountsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BankAccountsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankAccountData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankAccountData;

    public function retrieve(string $id): BankAccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankAccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankAccountData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BankAccountData;

    public function retrieveModel(): BankAccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BankAccountData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BankAccountData;

    public function destroyModel(): bool;
}
