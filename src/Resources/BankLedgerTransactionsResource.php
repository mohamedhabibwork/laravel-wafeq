<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BankLedgerTransactionsResourceContract;
use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankLedgerTransactionsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionsResource implements BankLedgerTransactionsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankLedgerTransactionData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/bank-ledger/', $query), BankLedgerTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankLedgerTransactionData
    {
        return $this->toData($this->postIdempotent($this->http, '/bank-ledger/', $payload), BankLedgerTransactionData::class);
    }

    public function retrieve(string $id): BankLedgerTransactionData
    {
        return $this->toData($this->http->get("/bank-ledger/{$id}/"), BankLedgerTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankLedgerTransactionData
    {
        return $this->toData($this->putIdempotent($this->http, "/bank-ledger/{$id}/", $payload), BankLedgerTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankLedgerTransactionData
    {
        return $this->toData($this->patchIdempotent($this->http, "/bank-ledger/{$id}/", $payload), BankLedgerTransactionData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-ledger/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
