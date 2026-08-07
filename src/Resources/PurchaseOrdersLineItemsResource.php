<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use Illuminate\Http\Client\PendingRequest;

/**
 * PurchaseOrdersLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrdersLineItemsResource implements PurchaseOrdersLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/purchase-orders/line-items/', $query), PurchaseOrderLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/purchase-orders/line-items/', $payload), PurchaseOrderLineItemData::class);
    }

    public function retrieve(string $id): PurchaseOrderLineItemData
    {
        return $this->toData($this->http->get("/purchase-orders/line-items/{$id}/"), PurchaseOrderLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/purchase-orders/line-items/{$id}/", $payload), PurchaseOrderLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/purchase-orders/line-items/{$id}/", $payload), PurchaseOrderLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/purchase-orders/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
