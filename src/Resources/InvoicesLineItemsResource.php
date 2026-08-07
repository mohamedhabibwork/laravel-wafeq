<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\InvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * InvoicesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class InvoicesLineItemsResource implements InvoicesLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/invoices/line-items/', $query), InvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/invoices/line-items/', $payload), InvoiceLineItemData::class);
    }

    public function retrieve(string $id): InvoiceLineItemData
    {
        return $this->toData($this->http->get("/invoices/line-items/{$id}/"), InvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/invoices/line-items/{$id}/", $payload), InvoiceLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/invoices/line-items/{$id}/", $payload), InvoiceLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/invoices/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
