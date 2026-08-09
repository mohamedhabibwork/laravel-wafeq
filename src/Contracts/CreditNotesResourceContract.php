<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * CreditNotesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface CreditNotesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteData;

    public function retrieve(string $id): CreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function taxAuthorityReport(string $id, array $payload = []): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): CreditNoteData;

    public function retrieveModel(): CreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): CreditNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): CreditNoteData;

    public function destroyModel(): bool;
}
