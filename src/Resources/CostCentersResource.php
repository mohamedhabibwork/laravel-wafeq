<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\CostCentersResourceContract;
use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * CostCentersResource Resource.
 *
 * @see LaravelWafeq
 */
class CostCentersResource implements CostCentersResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CostCenterData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/cost-centers/', $query), CostCenterData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CostCenterData
    {
        return $this->toData($this->postIdempotent($this->http, '/cost-centers/', $payload), CostCenterData::class);
    }

    public function retrieve(string $id): CostCenterData
    {
        return $this->toData($this->http->get("/cost-centers/{$id}/"), CostCenterData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CostCenterData
    {
        return $this->toData($this->putIdempotent($this->http, "/cost-centers/{$id}/", $payload), CostCenterData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CostCenterData
    {
        return $this->toData($this->patchIdempotent($this->http, "/cost-centers/{$id}/", $payload), CostCenterData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/cost-centers/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
