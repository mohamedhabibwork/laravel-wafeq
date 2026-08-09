<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBankAccountsModel;
use HWafeq\LaravelWafeq\Contracts\BankAccountsResourceContract;
use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountCreated;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountDestroyed;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountListed;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountRetrieved;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankAccountsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankAccountsResource implements BankAccountsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBankAccountsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankAccountData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/bank-accounts/', $query), BankAccountData::class);

        event(new BankAccountListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankAccountData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/bank-accounts/', $payload), BankAccountData::class);

        event(new BankAccountCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BankAccountData
    {
        $data = $this->toData($this->http->get("/bank-accounts/{$id}/"), BankAccountData::class);

        event(new BankAccountRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankAccountData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/bank-accounts/{$id}/", $payload), BankAccountData::class);

        event(new BankAccountUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankAccountData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/bank-accounts/{$id}/", $payload), BankAccountData::class);

        event(new BankAccountPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-accounts/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BankAccountDestroyed(BankAccountData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
