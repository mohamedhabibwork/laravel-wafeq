<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithItemUnitsOfMeasureModel;
use HWafeq\LaravelWafeq\Contracts\ItemUnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureCreated;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureDestroyed;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureListed;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasurePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureRetrieved;
use HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure\ItemUnitOfMeasureUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ItemUnitsOfMeasureResource Resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitsOfMeasureResource implements ItemUnitsOfMeasureResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithItemUnitsOfMeasureModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ItemUnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/item-units-of-measure/', $query), ItemUnitOfMeasureData::class);

        event(new ItemUnitOfMeasureListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ItemUnitOfMeasureData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/item-units-of-measure/', $payload), ItemUnitOfMeasureData::class);

        event(new ItemUnitOfMeasureCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ItemUnitOfMeasureData
    {
        $data = $this->toData($this->http->get("/item-units-of-measure/{$id}/"), ItemUnitOfMeasureData::class);

        event(new ItemUnitOfMeasureRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ItemUnitOfMeasureData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/item-units-of-measure/{$id}/", $payload), ItemUnitOfMeasureData::class);

        event(new ItemUnitOfMeasureUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ItemUnitOfMeasureData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/item-units-of-measure/{$id}/", $payload), ItemUnitOfMeasureData::class);

        event(new ItemUnitOfMeasurePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/item-units-of-measure/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ItemUnitOfMeasureDestroyed(ItemUnitOfMeasureData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
