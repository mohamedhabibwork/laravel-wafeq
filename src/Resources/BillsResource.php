<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBillsModel;
use HWafeq\LaravelWafeq\Contracts\BillsResourceContract;
use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Bills\BillCreated;
use HWafeq\LaravelWafeq\Events\Bills\BillDestroyed;
use HWafeq\LaravelWafeq\Events\Bills\BillDownloaded;
use HWafeq\LaravelWafeq\Events\Bills\BillListed;
use HWafeq\LaravelWafeq\Events\Bills\BillPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Bills\BillRetrieved;
use HWafeq\LaravelWafeq\Events\Bills\BillUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * BillsResource Resource.
 *
 * @see LaravelWafeq
 */
class BillsResource implements BillsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBillsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/bills/', $query), BillData::class);

        event(new BillListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/bills/', $payload), BillData::class);

        event(new BillCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BillData
    {
        $data = $this->toData($this->http->get("/bills/{$id}/"), BillData::class);

        event(new BillRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/bills/{$id}/", $payload), BillData::class);

        event(new BillUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/bills/{$id}/", $payload), BillData::class);

        event(new BillPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bills/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BillDestroyed(BillData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/bills/{$id}/download/");
        $this->guardResponse($response);

        event(new BillDownloaded(BillData::from(['id' => $id]), $id));

        return $response;
    }
}
