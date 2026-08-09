<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Contracts\FilesResourceContract;
use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Files\FileDestroyed;
use HWafeq\LaravelWafeq\Events\Files\FileListed;
use HWafeq\LaravelWafeq\Events\Files\FileRetrieved;
use HWafeq\LaravelWafeq\Events\Files\FileUploaded;
use HWafeq\LaravelWafeq\Events\Files\FileUploadedRaw;
use Illuminate\Http\Client\PendingRequest;

/**
 * FilesResource Resource.
 *
 * @see LaravelWafeq
 */
class FilesResource implements FilesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<FileData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/files/', $query), FileData::class);

        event(new FileListed($page, '', $query));

        return $page;
    }

    public function retrieve(string $id): FileData
    {
        $data = $this->toData($this->http->get("/files/{$id}/"), FileData::class);

        event(new FileRetrieved($data, $id));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/files/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new FileDestroyed(FileData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function upload(array $payload): FileData
    {
        $response = $this->postIdempotent($this->http, '/upload-file/', $payload);
        $this->guardResponse($response);

        $data = FileData::from($response->json());

        event(new FileUploaded($data, '', $payload));

        return $data;
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function uploadRaw(array $payload): FileData
    {
        $response = $this->postIdempotent($this->http, '/upload-file-raw/', $payload);
        $this->guardResponse($response);

        $data = FileData::from($response->json());

        event(new FileUploadedRaw($data, '', $payload));

        return $data;
    }
}
