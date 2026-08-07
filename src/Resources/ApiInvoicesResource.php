<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ApiInvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * ApiInvoicesResource Resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoicesResource implements ApiInvoicesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiInvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/api-invoices/', $query), ApiInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiInvoiceData
    {
        return $this->toData($this->postIdempotent($this->http, '/api-invoices/', $payload), ApiInvoiceData::class);
    }

    public function retrieve(string $id): ApiInvoiceData
    {
        return $this->toData($this->http->get("/api-invoices/{$id}/"), ApiInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiInvoiceData
    {
        return $this->toData($this->putIdempotent($this->http, "/api-invoices/{$id}/", $payload), ApiInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiInvoiceData
    {
        return $this->toData($this->patchIdempotent($this->http, "/api-invoices/{$id}/", $payload), ApiInvoiceData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/api-invoices/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/api-invoices/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }

    /**
     * @return array<string, mixed>
     */
    public function summary(string $id): array
    {
        $response = $this->http->get("/api-invoices/{$id}/summary/");
        $this->guardResponse($response);

        return (array) $response->json();
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     * @return array<string, mixed>
     */
    public function bulkSend(array $payload): array
    {
        $response = $this->postIdempotent($this->http, '/api-invoices/bulk_send/', $payload);
        $this->guardResponse($response);

        return (array) $response->json();
    }
}
