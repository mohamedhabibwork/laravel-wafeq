<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ProjectsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ProjectData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ProjectsResource Resource.
 *
 * @see LaravelWafeq
 */
class ProjectsResource implements ProjectsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ProjectData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/projects/', $query), ProjectData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ProjectData
    {
        return $this->toData($this->postIdempotent($this->http, '/projects/', $payload), ProjectData::class);
    }

    public function retrieve(string $id): ProjectData
    {
        return $this->toData($this->http->get("/projects/{$id}/"), ProjectData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ProjectData
    {
        return $this->toData($this->putIdempotent($this->http, "/projects/{$id}/", $payload), ProjectData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ProjectData
    {
        return $this->toData($this->patchIdempotent($this->http, "/projects/{$id}/", $payload), ProjectData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/projects/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
