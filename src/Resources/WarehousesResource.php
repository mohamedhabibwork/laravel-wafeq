<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\WarehousesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\WarehouseData;
use Illuminate\Http\Client\PendingRequest;

/**
 * WarehousesResource Resource.
 *
 * @see LaravelWafeq
 */
class WarehousesResource implements WarehousesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<WarehouseData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/warehouses/', $query), WarehouseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): WarehouseData
    {
        return $this->toData($this->postIdempotent($this->http, '/warehouses/', $payload), WarehouseData::class);
    }

    public function retrieve(string $id): WarehouseData
    {
        return $this->toData($this->http->get("/warehouses/{$id}/"), WarehouseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): WarehouseData
    {
        return $this->toData($this->putIdempotent($this->http, "/warehouses/{$id}/", $payload), WarehouseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): WarehouseData
    {
        return $this->toData($this->patchIdempotent($this->http, "/warehouses/{$id}/", $payload), WarehouseData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/warehouses/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
