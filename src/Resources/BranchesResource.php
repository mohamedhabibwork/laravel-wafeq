<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBranchesModel;
use HWafeq\LaravelWafeq\Contracts\BranchesResourceContract;
use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Branches\BranchCreated;
use HWafeq\LaravelWafeq\Events\Branches\BranchDestroyed;
use HWafeq\LaravelWafeq\Events\Branches\BranchListed;
use HWafeq\LaravelWafeq\Events\Branches\BranchPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Branches\BranchRetrieved;
use HWafeq\LaravelWafeq\Events\Branches\BranchUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BranchesResource Resource.
 *
 * @see LaravelWafeq
 */
class BranchesResource implements BranchesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBranchesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BranchData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/branches/', $query), BranchData::class);

        event(new BranchListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BranchData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/branches/', $payload), BranchData::class);

        event(new BranchCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BranchData
    {
        $data = $this->toData($this->http->get("/branches/{$id}/"), BranchData::class);

        event(new BranchRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BranchData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/branches/{$id}/", $payload), BranchData::class);

        event(new BranchUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BranchData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/branches/{$id}/", $payload), BranchData::class);

        event(new BranchPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/branches/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BranchDestroyed(BranchData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
