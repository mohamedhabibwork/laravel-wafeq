<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\CreditNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * CreditNotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class CreditNotesLineItemsResource implements CreditNotesLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/credit-notes/line-items/', $query), CreditNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/credit-notes/line-items/', $payload), CreditNoteLineItemData::class);
    }

    public function retrieve(string $id): CreditNoteLineItemData
    {
        return $this->toData($this->http->get("/credit-notes/line-items/{$id}/"), CreditNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/credit-notes/line-items/{$id}/", $payload), CreditNoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/credit-notes/line-items/{$id}/", $payload), CreditNoteLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/credit-notes/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
