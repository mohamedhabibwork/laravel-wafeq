<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\RevenueRecognitionsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use Illuminate\Http\Client\PendingRequest;

/**
 * RevenueRecognitionsResource Resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionsResource implements RevenueRecognitionsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<RevenueRecognitionData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/revenue-recognitions/', $query), RevenueRecognitionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): RevenueRecognitionData
    {
        return $this->toData($this->postIdempotent($this->http, '/revenue-recognitions/', $payload), RevenueRecognitionData::class);
    }

    public function retrieve(string $id): RevenueRecognitionData
    {
        return $this->toData($this->http->get("/revenue-recognitions/{$id}/"), RevenueRecognitionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): RevenueRecognitionData
    {
        return $this->toData($this->putIdempotent($this->http, "/revenue-recognitions/{$id}/", $payload), RevenueRecognitionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): RevenueRecognitionData
    {
        return $this->toData($this->patchIdempotent($this->http, "/revenue-recognitions/{$id}/", $payload), RevenueRecognitionData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/revenue-recognitions/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreate(array $payload): RevenueRecognitionData
    {
        return $this->toData($this->postIdempotent($this->http, '/revenue-recognitions/preview/', $payload), RevenueRecognitionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarly(string $id, array $payload = []): RevenueRecognitionData
    {
        return $this->toData($this->postIdempotent($this->http, "/revenue-recognitions/{$id}/end_early/", $payload), RevenueRecognitionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarly(string $id, array $payload = []): RevenueRecognitionData
    {
        return $this->toData($this->postIdempotent($this->http, "/revenue-recognitions/{$id}/preview_end_early/", $payload), RevenueRecognitionData::class);
    }
}
