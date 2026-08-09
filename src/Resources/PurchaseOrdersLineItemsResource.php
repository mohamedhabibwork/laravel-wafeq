<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPurchaseOrdersLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemCreated;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemListed;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems\PurchaseOrderLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * PurchaseOrdersLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrdersLineItemsResource implements PurchaseOrdersLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPurchaseOrdersLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/purchase-orders/line-items/', $query), PurchaseOrderLineItemData::class);

        event(new PurchaseOrderLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/purchase-orders/line-items/', $payload), PurchaseOrderLineItemData::class);

        event(new PurchaseOrderLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PurchaseOrderLineItemData
    {
        $data = $this->toData($this->http->get("/purchase-orders/line-items/{$id}/"), PurchaseOrderLineItemData::class);

        event(new PurchaseOrderLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/purchase-orders/line-items/{$id}/", $payload), PurchaseOrderLineItemData::class);

        event(new PurchaseOrderLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/purchase-orders/line-items/{$id}/", $payload), PurchaseOrderLineItemData::class);

        event(new PurchaseOrderLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/purchase-orders/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PurchaseOrderLineItemDestroyed(PurchaseOrderLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
