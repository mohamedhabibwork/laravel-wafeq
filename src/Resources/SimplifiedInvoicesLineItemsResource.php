<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use Illuminate\Http\Client\PendingRequest;

/**
 * SimplifiedInvoicesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoicesLineItemsResource implements SimplifiedInvoicesLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<SimplifiedInvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/simplified-invoices/line-items/', $query), SimplifiedInvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): SimplifiedInvoiceLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/simplified-invoices/line-items/', $payload), SimplifiedInvoiceLineItemData::class);
    }

    public function retrieve(string $id): SimplifiedInvoiceLineItemData
    {
        return $this->toData($this->http->get("/simplified-invoices/line-items/{$id}/"), SimplifiedInvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): SimplifiedInvoiceLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/simplified-invoices/line-items/{$id}/", $payload), SimplifiedInvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): SimplifiedInvoiceLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/simplified-invoices/line-items/{$id}/", $payload), SimplifiedInvoiceLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/simplified-invoices/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
