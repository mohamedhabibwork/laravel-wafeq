<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * JournalLineItemsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface JournalLineItemsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<JournalLineItemData>
     */
    public function list(array $query = []): PaginatedData;

    public function retrieve(string $id): JournalLineItemData;
}
