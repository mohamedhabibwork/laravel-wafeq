<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithDebitNotesModel;
use HWafeq\LaravelWafeq\Contracts\DebitNotesResourceContract;
use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteCreated;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteDestroyed;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteDownloaded;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteListed;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteRetrieved;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * DebitNotesResource Resource.
 *
 * @see LaravelWafeq
 */
class DebitNotesResource implements DebitNotesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithDebitNotesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<DebitNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/debit-notes/', $query), DebitNoteData::class);

        event(new DebitNoteListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): DebitNoteData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/debit-notes/', $payload), DebitNoteData::class);

        event(new DebitNoteCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): DebitNoteData
    {
        $data = $this->toData($this->http->get("/debit-notes/{$id}/"), DebitNoteData::class);

        event(new DebitNoteRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): DebitNoteData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/debit-notes/{$id}/", $payload), DebitNoteData::class);

        event(new DebitNoteUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): DebitNoteData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/debit-notes/{$id}/", $payload), DebitNoteData::class);

        event(new DebitNotePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/debit-notes/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new DebitNoteDestroyed(DebitNoteData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/debit-notes/{$id}/download/");
        $this->guardResponse($response);

        event(new DebitNoteDownloaded(DebitNoteData::from(['id' => $id]), $id));

        return $response;
    }
}
