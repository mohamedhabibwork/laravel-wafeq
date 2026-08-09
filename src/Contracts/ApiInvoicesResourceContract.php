<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * ApiInvoicesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ApiInvoicesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiInvoiceData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiInvoiceData;

    public function retrieve(string $id): ApiInvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiInvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiInvoiceData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @return array<string, mixed>
     */
    public function summary(string $id): array;

    /**
     * @param  array<int, array<string, mixed>>  $payload
     * @return array<string, mixed>
     */
    public function bulkSend(array $payload): array;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ApiInvoiceData;

    public function retrieveModel(): ApiInvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ApiInvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ApiInvoiceData;

    public function destroyModel(): bool;
}
