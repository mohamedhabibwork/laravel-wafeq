<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBillsLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\BillsLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemCreated;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemListed;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\BillsLineItems\BillLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BillsLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class BillsLineItemsResource implements BillsLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBillsLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/bills/line-items/', $query), BillLineItemData::class);

        event(new BillLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/bills/line-items/', $payload), BillLineItemData::class);

        event(new BillLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BillLineItemData
    {
        $data = $this->toData($this->http->get("/bills/line-items/{$id}/"), BillLineItemData::class);

        event(new BillLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/bills/line-items/{$id}/", $payload), BillLineItemData::class);

        event(new BillLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/bills/line-items/{$id}/", $payload), BillLineItemData::class);

        event(new BillLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bills/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BillLineItemDestroyed(BillLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
