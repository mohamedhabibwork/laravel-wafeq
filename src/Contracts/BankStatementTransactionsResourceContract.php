<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BankStatementTransactionsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BankStatementTransactionsResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BankStatementTransactionData;

    public function retrieveModel(): BankStatementTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BankStatementTransactionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BankStatementTransactionData;

    public function destroyModel(): bool;
}
