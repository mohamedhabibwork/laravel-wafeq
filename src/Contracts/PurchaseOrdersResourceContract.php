<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use Illuminate\Http\Client\Response;

/**
 * PurchaseOrdersResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PurchaseOrdersResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderData;

    public function retrieve(string $id): PurchaseOrderData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function bill(string $id, array $payload = []): BillData;
}
