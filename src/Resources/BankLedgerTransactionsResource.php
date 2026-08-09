<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBankLedgerTransactionsModel;
use HWafeq\LaravelWafeq\Contracts\BankLedgerTransactionsResourceContract;
use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionCreated;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionDestroyed;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionListed;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionRetrieved;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankLedgerTransactionsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionsResource implements BankLedgerTransactionsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBankLedgerTransactionsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankLedgerTransactionData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/bank-ledger/', $query), BankLedgerTransactionData::class);

        event(new BankLedgerTransactionListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankLedgerTransactionData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/bank-ledger/', $payload), BankLedgerTransactionData::class);

        event(new BankLedgerTransactionCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BankLedgerTransactionData
    {
        $data = $this->toData($this->http->get("/bank-ledger/{$id}/"), BankLedgerTransactionData::class);

        event(new BankLedgerTransactionRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankLedgerTransactionData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/bank-ledger/{$id}/", $payload), BankLedgerTransactionData::class);

        event(new BankLedgerTransactionUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankLedgerTransactionData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/bank-ledger/{$id}/", $payload), BankLedgerTransactionData::class);

        event(new BankLedgerTransactionPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-ledger/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BankLedgerTransactionDestroyed(BankLedgerTransactionData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
