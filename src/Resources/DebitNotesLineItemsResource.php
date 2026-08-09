<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithDebitNotesLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\DebitNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemListed;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * DebitNotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class DebitNotesLineItemsResource implements DebitNotesLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithDebitNotesLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<DebitNoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/debit-notes/line-items/', $query), DebitNoteLineItemData::class);

        event(new DebitNoteLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): DebitNoteLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/debit-notes/line-items/', $payload), DebitNoteLineItemData::class);

        event(new DebitNoteLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): DebitNoteLineItemData
    {
        $data = $this->toData($this->http->get("/debit-notes/line-items/{$id}/"), DebitNoteLineItemData::class);

        event(new DebitNoteLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): DebitNoteLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/debit-notes/line-items/{$id}/", $payload), DebitNoteLineItemData::class);

        event(new DebitNoteLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): DebitNoteLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/debit-notes/line-items/{$id}/", $payload), DebitNoteLineItemData::class);

        event(new DebitNoteLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/debit-notes/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new DebitNoteLineItemDestroyed(DebitNoteLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
