<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\UnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use Illuminate\Http\Client\PendingRequest;

/**
 * UnitsOfMeasureResource Resource.
 *
 * @see LaravelWafeq
 */
class UnitsOfMeasureResource implements UnitsOfMeasureResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<UnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/units-of-measure/', $query), UnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): UnitOfMeasureData
    {
        return $this->toData($this->postIdempotent($this->http, '/units-of-measure/', $payload), UnitOfMeasureData::class);
    }

    public function retrieve(string $id): UnitOfMeasureData
    {
        return $this->toData($this->http->get("/units-of-measure/{$id}/"), UnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): UnitOfMeasureData
    {
        return $this->toData($this->putIdempotent($this->http, "/units-of-measure/{$id}/", $payload), UnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): UnitOfMeasureData
    {
        return $this->toData($this->patchIdempotent($this->http, "/units-of-measure/{$id}/", $payload), UnitOfMeasureData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/units-of-measure/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
