<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithManualJournalsModel;
use HWafeq\LaravelWafeq\Contracts\ManualJournalsResourceContract;
use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalCreated;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalDestroyed;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalListed;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalRetrieved;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ManualJournalsResource Resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalsResource implements ManualJournalsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithManualJournalsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ManualJournalData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/manual-journals/', $query), ManualJournalData::class);

        event(new ManualJournalListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ManualJournalData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/manual-journals/', $payload), ManualJournalData::class);

        event(new ManualJournalCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ManualJournalData
    {
        $data = $this->toData($this->http->get("/manual-journals/{$id}/"), ManualJournalData::class);

        event(new ManualJournalRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ManualJournalData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/manual-journals/{$id}/", $payload), ManualJournalData::class);

        event(new ManualJournalUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ManualJournalData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/manual-journals/{$id}/", $payload), ManualJournalData::class);

        event(new ManualJournalPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/manual-journals/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ManualJournalDestroyed(ManualJournalData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
