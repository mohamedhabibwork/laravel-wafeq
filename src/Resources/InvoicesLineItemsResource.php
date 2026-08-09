<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithInvoicesLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\InvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemCreated;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemListed;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\InvoicesLineItems\InvoiceLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * InvoicesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class InvoicesLineItemsResource implements InvoicesLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithInvoicesLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/invoices/line-items/', $query), InvoiceLineItemData::class);

        event(new InvoiceLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/invoices/line-items/', $payload), InvoiceLineItemData::class);

        event(new InvoiceLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): InvoiceLineItemData
    {
        $data = $this->toData($this->http->get("/invoices/line-items/{$id}/"), InvoiceLineItemData::class);

        event(new InvoiceLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/invoices/line-items/{$id}/", $payload), InvoiceLineItemData::class);

        event(new InvoiceLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/invoices/line-items/{$id}/", $payload), InvoiceLineItemData::class);

        event(new InvoiceLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/invoices/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new InvoiceLineItemDestroyed(InvoiceLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
