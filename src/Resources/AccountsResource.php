<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\AccountsResourceContract;
use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * AccountsResource Resource.
 *
 * @see LaravelWafeq
 */
class AccountsResource implements AccountsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AccountData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/accounts/', $query), AccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AccountData
    {
        return $this->toData($this->postIdempotent($this->http, '/accounts/', $payload), AccountData::class);
    }

    public function retrieve(string $id): AccountData
    {
        return $this->toData($this->http->get("/accounts/{$id}/"), AccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AccountData
    {
        return $this->toData($this->putIdempotent($this->http, "/accounts/{$id}/", $payload), AccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AccountData
    {
        return $this->toData($this->patchIdempotent($this->http, "/accounts/{$id}/", $payload), AccountData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/accounts/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
