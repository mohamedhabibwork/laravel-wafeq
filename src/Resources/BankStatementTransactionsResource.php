<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBankStatementTransactionsModel;
use HWafeq\LaravelWafeq\Contracts\BankStatementTransactionsResourceContract;
use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionCreated;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionDestroyed;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionListed;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionRetrieved;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankStatementTransactionsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionsResource implements BankStatementTransactionsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBankStatementTransactionsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankStatementTransactionData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/bank-statement/', $query), BankStatementTransactionData::class);

        event(new BankStatementTransactionListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankStatementTransactionData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/bank-statement/', $payload), BankStatementTransactionData::class);

        event(new BankStatementTransactionCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BankStatementTransactionData
    {
        $data = $this->toData($this->http->get("/bank-statement/{$id}/"), BankStatementTransactionData::class);

        event(new BankStatementTransactionRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankStatementTransactionData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/bank-statement/{$id}/", $payload), BankStatementTransactionData::class);

        event(new BankStatementTransactionUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankStatementTransactionData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/bank-statement/{$id}/", $payload), BankStatementTransactionData::class);

        event(new BankStatementTransactionPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-statement/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BankStatementTransactionDestroyed(BankStatementTransactionData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
