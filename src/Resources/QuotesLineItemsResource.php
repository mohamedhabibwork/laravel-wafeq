<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\QuotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use Illuminate\Http\Client\PendingRequest;

/**
 * QuotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class QuotesLineItemsResource implements QuotesLineItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/quotes/line-items/', $query), QuoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteLineItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/quotes/line-items/', $payload), QuoteLineItemData::class);
    }

    public function retrieve(string $id): QuoteLineItemData
    {
        return $this->toData($this->http->get("/quotes/line-items/{$id}/"), QuoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteLineItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/quotes/line-items/{$id}/", $payload), QuoteLineItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteLineItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/quotes/line-items/{$id}/", $payload), QuoteLineItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/quotes/line-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
