<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BankStatementTransactionsResourceContract;
use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BankStatementTransactionsResource Resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionsResource implements BankStatementTransactionsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BankStatementTransactionData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/bank-statement/', $query), BankStatementTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BankStatementTransactionData
    {
        return $this->toData($this->postIdempotent($this->http, '/bank-statement/', $payload), BankStatementTransactionData::class);
    }

    public function retrieve(string $id): BankStatementTransactionData
    {
        return $this->toData($this->http->get("/bank-statement/{$id}/"), BankStatementTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BankStatementTransactionData
    {
        return $this->toData($this->putIdempotent($this->http, "/bank-statement/{$id}/", $payload), BankStatementTransactionData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BankStatementTransactionData
    {
        return $this->toData($this->patchIdempotent($this->http, "/bank-statement/{$id}/", $payload), BankStatementTransactionData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/bank-statement/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
