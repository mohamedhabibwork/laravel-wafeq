<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\AmortizationsResourceContract;
use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * AmortizationsResource Resource.
 *
 * @see LaravelWafeq
 */
class AmortizationsResource implements AmortizationsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AmortizationData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/amortizations/', $query), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, '/amortizations/', $payload), AmortizationData::class);
    }

    public function retrieve(string $id): AmortizationData
    {
        return $this->toData($this->http->get("/amortizations/{$id}/"), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AmortizationData
    {
        return $this->toData($this->putIdempotent($this->http, "/amortizations/{$id}/", $payload), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AmortizationData
    {
        return $this->toData($this->patchIdempotent($this->http, "/amortizations/{$id}/", $payload), AmortizationData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/amortizations/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreate(array $payload): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, '/amortizations/preview/', $payload), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarly(string $id, array $payload = []): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, "/amortizations/{$id}/end_early/", $payload), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarly(string $id, array $payload = []): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, "/amortizations/{$id}/preview_end_early/", $payload), AmortizationData::class);
    }
}
