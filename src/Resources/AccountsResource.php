<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithAccountsModel;
use HWafeq\LaravelWafeq\Contracts\AccountsResourceContract;
use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Accounts\AccountCreated;
use HWafeq\LaravelWafeq\Events\Accounts\AccountDestroyed;
use HWafeq\LaravelWafeq\Events\Accounts\AccountListed;
use HWafeq\LaravelWafeq\Events\Accounts\AccountPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Accounts\AccountRetrieved;
use HWafeq\LaravelWafeq\Events\Accounts\AccountUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * AccountsResource Resource.
 *
 * @see LaravelWafeq
 */
class AccountsResource implements AccountsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithAccountsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AccountData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/accounts/', $query), AccountData::class);

        event(new AccountListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AccountData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/accounts/', $payload), AccountData::class);

        event(new AccountCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): AccountData
    {
        $data = $this->toData($this->http->get("/accounts/{$id}/"), AccountData::class);

        event(new AccountRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AccountData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/accounts/{$id}/", $payload), AccountData::class);

        event(new AccountUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AccountData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/accounts/{$id}/", $payload), AccountData::class);

        event(new AccountPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/accounts/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new AccountDestroyed(AccountData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
