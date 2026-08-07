<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BillsResourceContract;
use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
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

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BillData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/bills/', $query), BillData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BillData
    {
        return $this->toData($this->postIdempotent($this->http, '/bills/', $payload), BillData::class);
    }

    public function retrieve(string $id): BillData
    {
        return $this->toData($this->http->get("/bills/{$id}/"), BillData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BillData
    {
        return $this->toData($this->putIdempotent($this->http, "/bills/{$id}/", $payload), BillData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BillData
    {
        return $this->toData($this->patchIdempotent($this->http, "/bills/{$id}/", $payload), BillData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bills/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/bills/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }
}
