<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BankAccountsResourceContract;
use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankAccountsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankAccountsResource implements BankAccountsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankAccountData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/bank-accounts/', $query), BankAccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankAccountData
    {
        return $this->toData($this->postIdempotent($this->http, '/bank-accounts/', $payload), BankAccountData::class);
    }

    public function retrieve(string $id): BankAccountData
    {
        return $this->toData($this->http->get("/bank-accounts/{$id}/"), BankAccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankAccountData
    {
        return $this->toData($this->putIdempotent($this->http, "/bank-accounts/{$id}/", $payload), BankAccountData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankAccountData
    {
        return $this->toData($this->patchIdempotent($this->http, "/bank-accounts/{$id}/", $payload), BankAccountData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-accounts/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
