<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithRevenueRecognitionsModel;
use HWafeq\LaravelWafeq\Contracts\RevenueRecognitionsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionCreated;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionDestroyed;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionListed;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionRetrieved;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * RevenueRecognitionsResource Resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionsResource implements RevenueRecognitionsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithRevenueRecognitionsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<RevenueRecognitionData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/revenue-recognitions/', $query), RevenueRecognitionData::class);

        event(new RevenueRecognitionListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): RevenueRecognitionData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/revenue-recognitions/', $payload), RevenueRecognitionData::class);

        event(new RevenueRecognitionCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): RevenueRecognitionData
    {
        $data = $this->toData($this->http->get("/revenue-recognitions/{$id}/"), RevenueRecognitionData::class);

        event(new RevenueRecognitionRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): RevenueRecognitionData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/revenue-recognitions/{$id}/", $payload), RevenueRecognitionData::class);

        event(new RevenueRecognitionUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): RevenueRecognitionData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/revenue-recognitions/{$id}/", $payload), RevenueRecognitionData::class);

        event(new RevenueRecognitionPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/revenue-recognitions/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new RevenueRecognitionDestroyed(RevenueRecognitionData::from(['id' => $id]), $id));
        }

        return $ok;
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
