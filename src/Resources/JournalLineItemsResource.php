<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Contracts\JournalLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\JournalLineItems\JournalLineItemListed;
use HWafeq\LaravelWafeq\Events\JournalLineItems\JournalLineItemRetrieved;
use Illuminate\Http\Client\PendingRequest;

/**
 * JournalLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class JournalLineItemsResource implements JournalLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<JournalLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/journal-line-items/', $query), JournalLineItemData::class);

        event(new JournalLineItemListed($page, '', $query));

        return $page;
    }

    public function retrieve(string $id): JournalLineItemData
    {
        $data = $this->toData($this->http->get("/journal-line-items/{$id}/"), JournalLineItemData::class);

        event(new JournalLineItemRetrieved($data, $id));

        return $data;
    }
}
