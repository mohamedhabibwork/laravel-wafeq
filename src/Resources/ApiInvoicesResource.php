<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithApiInvoicesModel;
use HWafeq\LaravelWafeq\Contracts\ApiInvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceCreated;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceDestroyed;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceDownloaded;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceListed;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoicePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceRetrieved;
use HWafeq\LaravelWafeq\Events\ApiInvoices\ApiInvoiceUpdated;
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
    use HoldsWafeqModel;
    use InteractsWithApiInvoicesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiInvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/api-invoices/', $query), ApiInvoiceData::class);

        event(new ApiInvoiceListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiInvoiceData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/api-invoices/', $payload), ApiInvoiceData::class);

        event(new ApiInvoiceCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ApiInvoiceData
    {
        $data = $this->toData($this->http->get("/api-invoices/{$id}/"), ApiInvoiceData::class);

        event(new ApiInvoiceRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiInvoiceData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/api-invoices/{$id}/", $payload), ApiInvoiceData::class);

        event(new ApiInvoiceUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiInvoiceData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/api-invoices/{$id}/", $payload), ApiInvoiceData::class);

        event(new ApiInvoicePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/api-invoices/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ApiInvoiceDestroyed(ApiInvoiceData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/api-invoices/{$id}/download/");
        $this->guardResponse($response);

        event(new ApiInvoiceDownloaded(ApiInvoiceData::from(['id' => $id]), $id));

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
