<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithSimplifiedInvoicesLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemCreated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemListed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems\SimplifiedInvoiceLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * SimplifiedInvoicesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoicesLineItemsResource implements SimplifiedInvoicesLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithSimplifiedInvoicesLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<SimplifiedInvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/simplified-invoices/line-items/', $query), SimplifiedInvoiceLineItemData::class);

        event(new SimplifiedInvoiceLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): SimplifiedInvoiceLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/simplified-invoices/line-items/', $payload), SimplifiedInvoiceLineItemData::class);

        event(new SimplifiedInvoiceLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): SimplifiedInvoiceLineItemData
    {
        $data = $this->toData($this->http->get("/simplified-invoices/line-items/{$id}/"), SimplifiedInvoiceLineItemData::class);

        event(new SimplifiedInvoiceLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): SimplifiedInvoiceLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/simplified-invoices/line-items/{$id}/", $payload), SimplifiedInvoiceLineItemData::class);

        event(new SimplifiedInvoiceLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): SimplifiedInvoiceLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/simplified-invoices/line-items/{$id}/", $payload), SimplifiedInvoiceLineItemData::class);

        event(new SimplifiedInvoiceLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/simplified-invoices/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new SimplifiedInvoiceLineItemDestroyed(SimplifiedInvoiceLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
