<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ContactsResourceContract;
use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ContactsResource Resource.
 *
 * @see LaravelWafeq
 */
class ContactsResource implements ContactsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ContactData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/contacts/', $query), ContactData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ContactData
    {
        return $this->toData($this->postIdempotent($this->http, '/contacts/', $payload), ContactData::class);
    }

    public function retrieve(string $id): ContactData
    {
        return $this->toData($this->http->get("/contacts/{$id}/"), ContactData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ContactData
    {
        return $this->toData($this->putIdempotent($this->http, "/contacts/{$id}/", $payload), ContactData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ContactData
    {
        return $this->toData($this->patchIdempotent($this->http, "/contacts/{$id}/", $payload), ContactData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/contacts/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
