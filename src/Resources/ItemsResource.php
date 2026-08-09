<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithItemsModel;
use HWafeq\LaravelWafeq\Contracts\ItemsResourceContract;
use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Items\ItemCreated;
use HWafeq\LaravelWafeq\Events\Items\ItemDestroyed;
use HWafeq\LaravelWafeq\Events\Items\ItemListed;
use HWafeq\LaravelWafeq\Events\Items\ItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Items\ItemRetrieved;
use HWafeq\LaravelWafeq\Events\Items\ItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class ItemsResource implements ItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/items/', $query), ItemData::class);

        event(new ItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/items/', $payload), ItemData::class);

        event(new ItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ItemData
    {
        $data = $this->toData($this->http->get("/items/{$id}/"), ItemData::class);

        event(new ItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/items/{$id}/", $payload), ItemData::class);

        event(new ItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/items/{$id}/", $payload), ItemData::class);

        event(new ItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ItemDestroyed(ItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
