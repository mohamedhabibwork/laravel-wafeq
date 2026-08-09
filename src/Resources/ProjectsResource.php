<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithProjectsModel;
use HWafeq\LaravelWafeq\Contracts\ProjectsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Projects\ProjectCreated;
use HWafeq\LaravelWafeq\Events\Projects\ProjectDestroyed;
use HWafeq\LaravelWafeq\Events\Projects\ProjectListed;
use HWafeq\LaravelWafeq\Events\Projects\ProjectPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Projects\ProjectRetrieved;
use HWafeq\LaravelWafeq\Events\Projects\ProjectUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ProjectsResource Resource.
 *
 * @see LaravelWafeq
 */
class ProjectsResource implements ProjectsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithProjectsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ProjectData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/projects/', $query), ProjectData::class);

        event(new ProjectListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ProjectData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/projects/', $payload), ProjectData::class);

        event(new ProjectCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ProjectData
    {
        $data = $this->toData($this->http->get("/projects/{$id}/"), ProjectData::class);

        event(new ProjectRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ProjectData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/projects/{$id}/", $payload), ProjectData::class);

        event(new ProjectUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ProjectData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/projects/{$id}/", $payload), ProjectData::class);

        event(new ProjectPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/projects/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ProjectDestroyed(ProjectData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
