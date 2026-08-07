<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\QuotesResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteData;
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

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/quotes/', $query), QuoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteData
    {
        return $this->toData($this->postIdempotent($this->http, '/quotes/', $payload), QuoteData::class);
    }

    public function retrieve(string $id): QuoteData
    {
        return $this->toData($this->http->get("/quotes/{$id}/"), QuoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteData
    {
        return $this->toData($this->putIdempotent($this->http, "/quotes/{$id}/", $payload), QuoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteData
    {
        return $this->toData($this->patchIdempotent($this->http, "/quotes/{$id}/", $payload), QuoteData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/quotes/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/quotes/{$id}/download/");
        $this->guardResponse($response);

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
