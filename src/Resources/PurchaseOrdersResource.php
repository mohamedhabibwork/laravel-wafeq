<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPurchaseOrdersModel;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersResourceContract;
use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderCreated;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderDestroyed;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderDownloaded;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderListed;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderRetrieved;
use HWafeq\LaravelWafeq\Events\PurchaseOrders\PurchaseOrderUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * PurchaseOrdersResource Resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrdersResource implements PurchaseOrdersResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPurchaseOrdersModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/purchase-orders/', $query), PurchaseOrderData::class);

        event(new PurchaseOrderListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/purchase-orders/', $payload), PurchaseOrderData::class);

        event(new PurchaseOrderCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PurchaseOrderData
    {
        $data = $this->toData($this->http->get("/purchase-orders/{$id}/"), PurchaseOrderData::class);

        event(new PurchaseOrderRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/purchase-orders/{$id}/", $payload), PurchaseOrderData::class);

        event(new PurchaseOrderUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/purchase-orders/{$id}/", $payload), PurchaseOrderData::class);

        event(new PurchaseOrderPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/purchase-orders/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PurchaseOrderDestroyed(PurchaseOrderData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/purchase-orders/{$id}/download/");
        $this->guardResponse($response);

        event(new PurchaseOrderDownloaded(PurchaseOrderData::from(['id' => $id]), $id));

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function bill(string $id, array $payload = []): BillData
    {
        return $this->toData($this->postIdempotent($this->http, "/purchase-orders/{$id}/bill/", $payload), BillData::class);
    }
}
