<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * ContactsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ContactsResourceContract extends ResourceContract
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
}
