<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BranchesResourceContract;
use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BranchesResource Resource.
 *
 * @see LaravelWafeq
 */
class BranchesResource implements BranchesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BranchData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/branches/', $query), BranchData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BranchData
    {
        return $this->toData($this->postIdempotent($this->http, '/branches/', $payload), BranchData::class);
    }

    public function retrieve(string $id): BranchData
    {
        return $this->toData($this->http->get("/branches/{$id}/"), BranchData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BranchData
    {
        return $this->toData($this->putIdempotent($this->http, "/branches/{$id}/", $payload), BranchData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BranchData
    {
        return $this->toData($this->patchIdempotent($this->http, "/branches/{$id}/", $payload), BranchData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/branches/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
