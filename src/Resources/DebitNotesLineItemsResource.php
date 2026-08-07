<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\DebitNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * DebitNotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class DebitNotesLineItemsResource implements DebitNotesLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<DebitNoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/debit-notes/line-items/', $query), DebitNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): DebitNoteLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/debit-notes/line-items/', $payload), DebitNoteLineItemData::class);
    }

    public function retrieve(string $id): DebitNoteLineItemData
    {
        return $this->toData($this->http->get("/debit-notes/line-items/{$id}/"), DebitNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): DebitNoteLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/debit-notes/line-items/{$id}/", $payload), DebitNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): DebitNoteLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/debit-notes/line-items/{$id}/", $payload), DebitNoteLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/debit-notes/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
