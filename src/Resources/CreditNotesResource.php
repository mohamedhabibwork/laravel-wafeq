<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\CreditNotesResourceContract;
use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * CreditNotesResource Resource.
 *
 * @see LaravelWafeq
 */
class CreditNotesResource implements CreditNotesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/credit-notes/', $query), CreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteData
    {
        return $this->toData($this->postIdempotent($this->http, '/credit-notes/', $payload), CreditNoteData::class);
    }

    public function retrieve(string $id): CreditNoteData
    {
        return $this->toData($this->http->get("/credit-notes/{$id}/"), CreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteData
    {
        return $this->toData($this->putIdempotent($this->http, "/credit-notes/{$id}/", $payload), CreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteData
    {
        return $this->toData($this->patchIdempotent($this->http, "/credit-notes/{$id}/", $payload), CreditNoteData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/credit-notes/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/credit-notes/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function taxAuthorityReport(string $id, array $payload = []): Response
    {
        $response = $this->postIdempotent($this->http, "/credit-notes/{$id}/tax_authority_report/", $payload);
        $this->guardResponse($response);

        return $response;
    }
}
