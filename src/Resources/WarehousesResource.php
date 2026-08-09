<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithWarehousesModel;
use HWafeq\LaravelWafeq\Contracts\WarehousesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseCreated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseDestroyed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseListed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehousePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseRetrieved;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * WarehousesResource Resource.
 *
 * @see LaravelWafeq
 */
class WarehousesResource implements WarehousesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithWarehousesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<WarehouseData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/warehouses/', $query), WarehouseData::class);

        event(new WarehouseListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): WarehouseData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/warehouses/', $payload), WarehouseData::class);

        event(new WarehouseCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): WarehouseData
    {
        $data = $this->toData($this->http->get("/warehouses/{$id}/"), WarehouseData::class);

        event(new WarehouseRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): WarehouseData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/warehouses/{$id}/", $payload), WarehouseData::class);

        event(new WarehouseUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): WarehouseData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/warehouses/{$id}/", $payload), WarehouseData::class);

        event(new WarehousePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/warehouses/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new WarehouseDestroyed(WarehouseData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
