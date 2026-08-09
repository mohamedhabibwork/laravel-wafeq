<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * ApiCreditNotesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ApiCreditNotesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiCreditNoteData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiCreditNoteData;

    public function retrieve(string $id): ApiCreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiCreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiCreditNoteData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<int, array<string, mixed>>  $payload
     * @return array<string, mixed>
     */
    public function bulkSend(array $payload): array;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ApiCreditNoteData;

    public function retrieveModel(): ApiCreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ApiCreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ApiCreditNoteData;

    public function destroyModel(): bool;
}
