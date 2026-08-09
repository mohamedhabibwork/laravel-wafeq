<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithApiCreditNotesModel;
use HWafeq\LaravelWafeq\Contracts\ApiCreditNotesResourceContract;
use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteCreated;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteDestroyed;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteDownloaded;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteListed;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteRetrieved;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteUpdated;
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
    use HoldsWafeqModel;
    use InteractsWithApiCreditNotesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ApiCreditNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/api-credit-notes/', $query), ApiCreditNoteData::class);

        event(new ApiCreditNoteListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ApiCreditNoteData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/api-credit-notes/', $payload), ApiCreditNoteData::class);

        event(new ApiCreditNoteCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ApiCreditNoteData
    {
        $data = $this->toData($this->http->get("/api-credit-notes/{$id}/"), ApiCreditNoteData::class);

        event(new ApiCreditNoteRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ApiCreditNoteData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/api-credit-notes/{$id}/", $payload), ApiCreditNoteData::class);

        event(new ApiCreditNoteUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ApiCreditNoteData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/api-credit-notes/{$id}/", $payload), ApiCreditNoteData::class);

        event(new ApiCreditNotePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/api-credit-notes/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ApiCreditNoteDestroyed(ApiCreditNoteData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/api-credit-notes/{$id}/download/");
        $this->guardResponse($response);

        event(new ApiCreditNoteDownloaded(ApiCreditNoteData::from(['id' => $id]), $id));

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
