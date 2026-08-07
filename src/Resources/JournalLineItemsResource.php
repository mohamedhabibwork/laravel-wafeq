<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\JournalLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * JournalLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class JournalLineItemsResource implements JournalLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<JournalLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/journal-line-items/', $query), JournalLineItemData::class);
    }

    public function retrieve(string $id): JournalLineItemData
    {
        return $this->toData($this->http->get("/journal-line-items/{$id}/"), JournalLineItemData::class);
    }
}
