<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ExpensesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ExpensesResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * Move a posted expense back to draft (removes its journal from the ledger).
     *
     * @param  array<string, mixed>  $payload
     */
    public function markAsDraft(string $id, array $payload = []): ExpenseData;

    /**
     * Post a draft expense to the ledger (generates its journal).
     *
     * @param  array<string, mixed>  $payload
     */
    public function markAsPosted(string $id, array $payload = []): ExpenseData;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ExpenseData;

    public function retrieveModel(): ExpenseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ExpenseData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ExpenseData;

    public function destroyModel(): bool;
}
