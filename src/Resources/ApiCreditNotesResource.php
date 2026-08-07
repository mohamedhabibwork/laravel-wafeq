<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ApiCreditNotesResourceContract;
use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * ApiCreditNotesResource Resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNotesResource implements ApiCreditNotesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiCreditNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/api-credit-notes/', $query), ApiCreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiCreditNoteData
    {
        return $this->toData($this->postIdempotent($this->http, '/api-credit-notes/', $payload), ApiCreditNoteData::class);
    }

    public function retrieve(string $id): ApiCreditNoteData
    {
        return $this->toData($this->http->get("/api-credit-notes/{$id}/"), ApiCreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiCreditNoteData
    {
        return $this->toData($this->putIdempotent($this->http, "/api-credit-notes/{$id}/", $payload), ApiCreditNoteData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiCreditNoteData
    {
        return $this->toData($this->patchIdempotent($this->http, "/api-credit-notes/{$id}/", $payload), ApiCreditNoteData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/api-credit-notes/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/api-credit-notes/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }

    /**
     * @param  array<int, array<string, mixed>>  $payload
     * @return array<string, mixed>
     */
    public function bulkSend(array $payload): array
    {
        $response = $this->postIdempotent($this->http, '/api-credit-notes/bulk_send/', $payload);
        $this->guardResponse($response);

        return (array) $response->json();
    }
}
