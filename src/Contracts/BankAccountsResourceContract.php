<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BankAccountsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BankAccountsResourceContract extends ResourceContract
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
}
