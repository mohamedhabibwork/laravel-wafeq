<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * InvoicesResource Resource.
 *
 * @see LaravelWafeq
 */
class InvoicesResource implements InvoicesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/invoices/', $query), InvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceData
    {
        return $this->toData($this->postIdempotent($this->http, '/invoices/', $payload), InvoiceData::class);
    }

    public function retrieve(string $id): InvoiceData
    {
        return $this->toData($this->http->get("/invoices/{$id}/"), InvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceData
    {
        return $this->toData($this->putIdempotent($this->http, "/invoices/{$id}/", $payload), InvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceData
    {
        return $this->toData($this->patchIdempotent($this->http, "/invoices/{$id}/", $payload), InvoiceData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/invoices/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/invoices/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function taxAuthorityReport(string $id, array $payload = []): Response
    {
        $response = $this->postIdempotent($this->http, "/invoices/{$id}/tax_authority_report/", $payload);
        $this->guardResponse($response);

        return $response;
    }
}
