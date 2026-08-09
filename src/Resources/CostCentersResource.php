<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithCostCentersModel;
use HWafeq\LaravelWafeq\Contracts\CostCentersResourceContract;
use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterCreated;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterDestroyed;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterListed;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterRetrieved;
use HWafeq\LaravelWafeq\Events\CostCenters\CostCenterUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * CostCentersResource Resource.
 *
 * @see LaravelWafeq
 */
class CostCentersResource implements CostCentersResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithCostCentersModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CostCenterData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/cost-centers/', $query), CostCenterData::class);

        event(new CostCenterListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CostCenterData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/cost-centers/', $payload), CostCenterData::class);

        event(new CostCenterCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): CostCenterData
    {
        $data = $this->toData($this->http->get("/cost-centers/{$id}/"), CostCenterData::class);

        event(new CostCenterRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CostCenterData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/cost-centers/{$id}/", $payload), CostCenterData::class);

        event(new CostCenterUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CostCenterData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/cost-centers/{$id}/", $payload), CostCenterData::class);

        event(new CostCenterPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/cost-centers/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new CostCenterDestroyed(CostCenterData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
