<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ExpensesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ExpensesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ExpenseData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ExpenseData;

    public function retrieve(string $id): ExpenseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ExpenseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ExpenseData;

    public function destroy(string $id): bool;
}
