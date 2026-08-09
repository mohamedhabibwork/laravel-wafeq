<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithSimplifiedInvoicesModel;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceCreated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceDestroyed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceDownloaded;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceListed;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoicePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceRetrieved;
use HWafeq\LaravelWafeq\Events\SimplifiedInvoices\SimplifiedInvoiceUpdated;
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
    use HoldsWafeqModel;
    use InteractsWithSimplifiedInvoicesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<SimplifiedInvoiceData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/simplified-invoices/', $query), SimplifiedInvoiceData::class);

        event(new SimplifiedInvoiceListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): SimplifiedInvoiceData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/simplified-invoices/', $payload), SimplifiedInvoiceData::class);

        event(new SimplifiedInvoiceCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): SimplifiedInvoiceData
    {
        $data = $this->toData($this->http->get("/simplified-invoices/{$id}/"), SimplifiedInvoiceData::class);

        event(new SimplifiedInvoiceRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): SimplifiedInvoiceData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/simplified-invoices/{$id}/", $payload), SimplifiedInvoiceData::class);

        event(new SimplifiedInvoiceUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): SimplifiedInvoiceData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/simplified-invoices/{$id}/", $payload), SimplifiedInvoiceData::class);

        event(new SimplifiedInvoicePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/simplified-invoices/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new SimplifiedInvoiceDestroyed(SimplifiedInvoiceData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/simplified-invoices/{$id}/download/");
        $this->guardResponse($response);

        event(new SimplifiedInvoiceDownloaded(SimplifiedInvoiceData::from(['id' => $id]), $id));

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
