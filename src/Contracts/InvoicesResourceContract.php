<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * InvoicesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface InvoicesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceData;

    public function retrieve(string $id): InvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function taxAuthorityReport(string $id, array $payload = []): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): InvoiceData;

    public function retrieveModel(): InvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): InvoiceData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): InvoiceData;

    public function destroyModel(): bool;
}
