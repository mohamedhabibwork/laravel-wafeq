<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipPayItemData;

/**
 * PayslipsPayItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PayslipsPayItemsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipPayItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipPayItemData;

    public function retrieve(string $id): PayslipPayItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipPayItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipPayItemData;

    public function destroy(string $id): bool;
}
