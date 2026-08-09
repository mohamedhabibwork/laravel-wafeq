<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithQuotesModel;
use HWafeq\LaravelWafeq\Contracts\QuotesResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteCreated;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteDestroyed;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteDownloaded;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteListed;
use HWafeq\LaravelWafeq\Events\Quotes\QuotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteRetrieved;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * QuotesResource Resource.
 *
 * @see LaravelWafeq
 */
class QuotesResource implements QuotesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithQuotesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/quotes/', $query), QuoteData::class);

        event(new QuoteListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/quotes/', $payload), QuoteData::class);

        event(new QuoteCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): QuoteData
    {
        $data = $this->toData($this->http->get("/quotes/{$id}/"), QuoteData::class);

        event(new QuoteRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/quotes/{$id}/", $payload), QuoteData::class);

        event(new QuoteUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/quotes/{$id}/", $payload), QuoteData::class);

        event(new QuotePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/quotes/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new QuoteDestroyed(QuoteData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/quotes/{$id}/download/");
        $this->guardResponse($response);

        event(new QuoteDownloaded(QuoteData::from(['id' => $id]), $id));

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function invoice(string $id, array $payload = []): InvoiceData
    {
        return $this->toData($this->postIdempotent($this->http, "/quotes/{$id}/invoice/", $payload), InvoiceData::class);
    }
}
