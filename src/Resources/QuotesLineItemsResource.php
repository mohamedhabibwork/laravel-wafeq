<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithQuotesLineItemsModel;
use HWafeq\LaravelWafeq\Contracts\QuotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemListed;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\QuotesLineItems\QuoteLineItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * QuotesLineItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class QuotesLineItemsResource implements QuotesLineItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithQuotesLineItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteLineItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/quotes/line-items/', $query), QuoteLineItemData::class);

        event(new QuoteLineItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteLineItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/quotes/line-items/', $payload), QuoteLineItemData::class);

        event(new QuoteLineItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): QuoteLineItemData
    {
        $data = $this->toData($this->http->get("/quotes/line-items/{$id}/"), QuoteLineItemData::class);

        event(new QuoteLineItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteLineItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/quotes/line-items/{$id}/", $payload), QuoteLineItemData::class);

        event(new QuoteLineItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteLineItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/quotes/line-items/{$id}/", $payload), QuoteLineItemData::class);

        event(new QuoteLineItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/quotes/line-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new QuoteLineItemDestroyed(QuoteLineItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
