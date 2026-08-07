<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ItemUnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ItemUnitsOfMeasureResource Resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitsOfMeasureResource implements ItemUnitsOfMeasureResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ItemUnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/item-units-of-measure/', $query), ItemUnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ItemUnitOfMeasureData
    {
        return $this->toData($this->postIdempotent($this->http, '/item-units-of-measure/', $payload), ItemUnitOfMeasureData::class);
    }

    public function retrieve(string $id): ItemUnitOfMeasureData
    {
        return $this->toData($this->http->get("/item-units-of-measure/{$id}/"), ItemUnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ItemUnitOfMeasureData
    {
        return $this->toData($this->putIdempotent($this->http, "/item-units-of-measure/{$id}/", $payload), ItemUnitOfMeasureData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ItemUnitOfMeasureData
    {
        return $this->toData($this->patchIdempotent($this->http, "/item-units-of-measure/{$id}/", $payload), ItemUnitOfMeasureData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/item-units-of-measure/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
