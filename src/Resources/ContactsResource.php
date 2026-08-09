<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithContactsModel;
use HWafeq\LaravelWafeq\Contracts\ContactsResourceContract;
use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Contacts\ContactCreated;
use HWafeq\LaravelWafeq\Events\Contacts\ContactDestroyed;
use HWafeq\LaravelWafeq\Events\Contacts\ContactListed;
use HWafeq\LaravelWafeq\Events\Contacts\ContactPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Contacts\ContactRetrieved;
use HWafeq\LaravelWafeq\Events\Contacts\ContactUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ContactsResource Resource.
 *
 * @see LaravelWafeq
 */
class ContactsResource implements ContactsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithContactsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ContactData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/contacts/', $query), ContactData::class);

        event(new ContactListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ContactData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/contacts/', $payload), ContactData::class);

        event(new ContactCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ContactData
    {
        $data = $this->toData($this->http->get("/contacts/{$id}/"), ContactData::class);

        event(new ContactRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ContactData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/contacts/{$id}/", $payload), ContactData::class);

        event(new ContactUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ContactData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/contacts/{$id}/", $payload), ContactData::class);

        event(new ContactPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/contacts/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ContactDestroyed(ContactData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
