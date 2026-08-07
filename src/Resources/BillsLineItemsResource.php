<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BillsLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BillsLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class BillsLineItemsResource implements BillsLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/bills/line-items/', $query), BillLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/bills/line-items/', $payload), BillLineItemData::class);
    }

    public function retrieve(string $id): BillLineItemData
    {
        return $this->toData($this->http->get("/bills/line-items/{$id}/"), BillLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/bills/line-items/{$id}/", $payload), BillLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/bills/line-items/{$id}/", $payload), BillLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bills/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
