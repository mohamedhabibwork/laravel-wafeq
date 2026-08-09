<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * CreditNotesLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface CreditNotesLineItemsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteLineItemData;

    public function retrieve(string $id): CreditNoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteLineItemData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): CreditNoteLineItemData;

    public function retrieveModel(): CreditNoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): CreditNoteLineItemData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): CreditNoteLineItemData;

    public function destroyModel(): bool;
}
