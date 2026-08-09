<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithCreditNotesModel;
use HWafeq\LaravelWafeq\Contracts\CreditNotesResourceContract;
use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteCreated;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteDestroyed;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteDownloaded;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteListed;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteRetrieved;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteUpdated;
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
    use HoldsWafeqModel;
    use InteractsWithCreditNotesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CreditNoteData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/credit-notes/', $query), CreditNoteData::class);

        event(new CreditNoteListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CreditNoteData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/credit-notes/', $payload), CreditNoteData::class);

        event(new CreditNoteCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): CreditNoteData
    {
        $data = $this->toData($this->http->get("/credit-notes/{$id}/"), CreditNoteData::class);

        event(new CreditNoteRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CreditNoteData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/credit-notes/{$id}/", $payload), CreditNoteData::class);

        event(new CreditNoteUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CreditNoteData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/credit-notes/{$id}/", $payload), CreditNoteData::class);

        event(new CreditNotePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/credit-notes/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new CreditNoteDestroyed(CreditNoteData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/credit-notes/{$id}/download/");
        $this->guardResponse($response);

        event(new CreditNoteDownloaded(CreditNoteData::from(['id' => $id]), $id));

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
