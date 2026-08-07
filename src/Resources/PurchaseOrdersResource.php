<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersResourceContract;
use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
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

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PurchaseOrderData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/purchase-orders/', $query), PurchaseOrderData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PurchaseOrderData
    {
        return $this->toData($this->postIdempotent($this->http, '/purchase-orders/', $payload), PurchaseOrderData::class);
    }

    public function retrieve(string $id): PurchaseOrderData
    {
        return $this->toData($this->http->get("/purchase-orders/{$id}/"), PurchaseOrderData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PurchaseOrderData
    {
        return $this->toData($this->putIdempotent($this->http, "/purchase-orders/{$id}/", $payload), PurchaseOrderData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PurchaseOrderData
    {
        return $this->toData($this->patchIdempotent($this->http, "/purchase-orders/{$id}/", $payload), PurchaseOrderData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/purchase-orders/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/purchase-orders/{$id}/download/");
        $this->guardResponse($response);

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
