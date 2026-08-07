<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\DebitNotesResourceContract;
use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
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

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<DebitNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/debit-notes/', $query), DebitNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): DebitNoteData
    {
        return $this->toData($this->postIdempotent($this->http, '/debit-notes/', $payload), DebitNoteData::class);
    }

    public function retrieve(string $id): DebitNoteData
    {
        return $this->toData($this->http->get("/debit-notes/{$id}/"), DebitNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): DebitNoteData
    {
        return $this->toData($this->putIdempotent($this->http, "/debit-notes/{$id}/", $payload), DebitNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): DebitNoteData
    {
        return $this->toData($this->patchIdempotent($this->http, "/debit-notes/{$id}/", $payload), DebitNoteData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/debit-notes/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/debit-notes/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }
}
