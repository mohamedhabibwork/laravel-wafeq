<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\FilesResourceContract;
use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * FilesResource Resource.
 *
 * @see LaravelWafeq
 */
class FilesResource implements FilesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<FileData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/files/', $query), FileData::class);
    }

    public function retrieve(string $id): FileData
    {
        return $this->toData($this->http->get("/files/{$id}/"), FileData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/files/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function upload(array $payload): FileData
    {
        $response = $this->postIdempotent($this->http, '/upload-file/', $payload);
        $this->guardResponse($response);

        return FileData::from($response->json());
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function uploadRaw(array $payload): FileData
    {
        $response = $this->postIdempotent($this->http, '/upload-file-raw/', $payload);
        $this->guardResponse($response);

        return FileData::from($response->json());
    }
}
