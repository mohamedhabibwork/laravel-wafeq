<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BankStatementTransactionsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BankStatementTransactionsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankStatementTransactionData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankStatementTransactionData;

    public function retrieve(string $id): BankStatementTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankStatementTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankStatementTransactionData;

    public function destroy(string $id): bool;
}
