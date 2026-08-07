<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * SimplifiedInvoicesResource Resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoicesResource implements SimplifiedInvoicesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<SimplifiedInvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/simplified-invoices/', $query), SimplifiedInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): SimplifiedInvoiceData
    {
        return $this->toData($this->postIdempotent($this->http, '/simplified-invoices/', $payload), SimplifiedInvoiceData::class);
    }

    public function retrieve(string $id): SimplifiedInvoiceData
    {
        return $this->toData($this->http->get("/simplified-invoices/{$id}/"), SimplifiedInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): SimplifiedInvoiceData
    {
        return $this->toData($this->putIdempotent($this->http, "/simplified-invoices/{$id}/", $payload), SimplifiedInvoiceData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): SimplifiedInvoiceData
    {
        return $this->toData($this->patchIdempotent($this->http, "/simplified-invoices/{$id}/", $payload), SimplifiedInvoiceData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/simplified-invoices/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/simplified-invoices/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function taxAuthorityReport(string $id, array $payload = []): Response
    {
        $response = $this->postIdempotent($this->http, "/simplified-invoices/{$id}/tax_authority_report/", $payload);
        $this->guardResponse($response);

        return $response;
    }
}
