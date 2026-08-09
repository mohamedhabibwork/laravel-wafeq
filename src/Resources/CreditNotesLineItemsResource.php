<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithCreditNotesLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\CreditNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemListed;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * CreditNotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class CreditNotesLineItemsResource implements CreditNotesLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithCreditNotesLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/credit-notes/line-items/', $query), CreditNoteLineItemData::class);

        event(new CreditNoteLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/credit-notes/line-items/', $payload), CreditNoteLineItemData::class);

        event(new CreditNoteLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): CreditNoteLineItemData
    {
        $data = $this->toData($this->http->get("/credit-notes/line-items/{$id}/"), CreditNoteLineItemData::class);

        event(new CreditNoteLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/credit-notes/line-items/{$id}/", $payload), CreditNoteLineItemData::class);

        event(new CreditNoteLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/credit-notes/line-items/{$id}/", $payload), CreditNoteLineItemData::class);

        event(new CreditNoteLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/credit-notes/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new CreditNoteLineItemDestroyed(CreditNoteLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
