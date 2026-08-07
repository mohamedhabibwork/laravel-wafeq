<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\ExpensesResourceContract;
use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ExpensesResource Resource.
 *
 * @see LaravelWafeq
 */
class ExpensesResource implements ExpensesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ExpenseData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/expenses/', $query), ExpenseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ExpenseData
    {
        return $this->toData($this->postIdempotent($this->http, '/expenses/', $payload), ExpenseData::class);
    }

    public function retrieve(string $id): ExpenseData
    {
        return $this->toData($this->http->get("/expenses/{$id}/"), ExpenseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ExpenseData
    {
        return $this->toData($this->putIdempotent($this->http, "/expenses/{$id}/", $payload), ExpenseData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ExpenseData
    {
        return $this->toData($this->patchIdempotent($this->http, "/expenses/{$id}/", $payload), ExpenseData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/expenses/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
