<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ManualJournalsResourceContract;
use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ManualJournalsResource Resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalsResource implements ManualJournalsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ManualJournalData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/manual-journals/', $query), ManualJournalData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ManualJournalData
    {
        return $this->toData($this->postIdempotent($this->http, '/manual-journals/', $payload), ManualJournalData::class);
    }

    public function retrieve(string $id): ManualJournalData
    {
        return $this->toData($this->http->get("/manual-journals/{$id}/"), ManualJournalData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ManualJournalData
    {
        return $this->toData($this->putIdempotent($this->http, "/manual-journals/{$id}/", $payload), ManualJournalData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ManualJournalData
    {
        return $this->toData($this->patchIdempotent($this->http, "/manual-journals/{$id}/", $payload), ManualJournalData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/manual-journals/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
