<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithInvoicesModel;
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceCreated;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceDestroyed;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceDownloaded;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceListed;
use HWafeq\LaravelWafeq\Events\Invoices\InvoicePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceRetrieved;
use HWafeq\LaravelWafeq\Events\Invoices\InvoiceUpdated;
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
    use HoldsWafeqModel;
    use InteractsWithInvoicesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<InvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/invoices/', $query), InvoiceData::class);

        event(new InvoiceListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): InvoiceData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/invoices/', $payload), InvoiceData::class);

        event(new InvoiceCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): InvoiceData
    {
        $data = $this->toData($this->http->get("/invoices/{$id}/"), InvoiceData::class);

        event(new InvoiceRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): InvoiceData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/invoices/{$id}/", $payload), InvoiceData::class);

        event(new InvoiceUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): InvoiceData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/invoices/{$id}/", $payload), InvoiceData::class);

        event(new InvoicePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/invoices/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new InvoiceDestroyed(InvoiceData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/invoices/{$id}/download/");
        $this->guardResponse($response);

        event(new InvoiceDownloaded(InvoiceData::from(['id' => $id]), $id));

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
