<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BankLedgerTransactionsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BankLedgerTransactionsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankLedgerTransactionData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankLedgerTransactionData;

    public function retrieve(string $id): BankLedgerTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankLedgerTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankLedgerTransactionData;

    public function destroy(string $id): bool;
}
