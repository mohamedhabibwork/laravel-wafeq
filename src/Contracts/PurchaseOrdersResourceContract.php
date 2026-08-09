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
interface PurchaseOrdersResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): PurchaseOrderData;

    public function retrieveModel(): PurchaseOrderData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): PurchaseOrderData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): PurchaseOrderData;

    public function destroyModel(): bool;
}
