<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ManualJournalsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ManualJournalsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ManualJournalData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ManualJournalData;

    public function retrieve(string $id): ManualJournalData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ManualJournalData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ManualJournalData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ManualJournalData;

    public function retrieveModel(): ManualJournalData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ManualJournalData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ManualJournalData;

    public function destroyModel(): bool;
}
