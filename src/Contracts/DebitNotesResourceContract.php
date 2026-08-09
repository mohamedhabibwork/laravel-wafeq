<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

/**
 * DebitNotesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface DebitNotesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<DebitNoteData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): DebitNoteData;

    public function retrieve(string $id): DebitNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): DebitNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): DebitNoteData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): DebitNoteData;

    public function retrieveModel(): DebitNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): DebitNoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): DebitNoteData;

    public function destroyModel(): bool;
}
