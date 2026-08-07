<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\CustomFieldsResourceContract;
use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * CustomFieldsResource Resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldsResource implements CustomFieldsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CustomFieldData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/custom-fields/', $query), CustomFieldData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CustomFieldData
    {
        return $this->toData($this->postIdempotent($this->http, '/custom-fields/', $payload), CustomFieldData::class);
    }

    public function retrieve(string $id): CustomFieldData
    {
        return $this->toData($this->http->get("/custom-fields/{$id}/"), CustomFieldData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CustomFieldData
    {
        return $this->toData($this->putIdempotent($this->http, "/custom-fields/{$id}/", $payload), CustomFieldData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CustomFieldData
    {
        return $this->toData($this->patchIdempotent($this->http, "/custom-fields/{$id}/", $payload), CustomFieldData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/custom-fields/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
