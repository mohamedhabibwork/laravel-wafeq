<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ContactsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ContactsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ContactData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ContactData;

    public function retrieve(string $id): ContactData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ContactData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ContactData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ContactData;

    public function retrieveModel(): ContactData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ContactData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ContactData;

    public function destroyModel(): bool;
}
