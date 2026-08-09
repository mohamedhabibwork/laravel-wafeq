<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithExpensesModel;
use HWafeq\LaravelWafeq\Contracts\ExpensesResourceContract;
use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseCreated;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseDestroyed;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseListed;
use HWafeq\LaravelWafeq\Events\Expenses\ExpensePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseRetrieved;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ExpensesResource Resource.
 *
 * @see LaravelWafeq
 */
class ExpensesResource implements ExpensesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithExpensesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ExpenseData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/expenses/', $query), ExpenseData::class);

        event(new ExpenseListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ExpenseData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/expenses/', $payload), ExpenseData::class);

        event(new ExpenseCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ExpenseData
    {
        $data = $this->toData($this->http->get("/expenses/{$id}/"), ExpenseData::class);

        event(new ExpenseRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ExpenseData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/expenses/{$id}/", $payload), ExpenseData::class);

        event(new ExpenseUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ExpenseData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/expenses/{$id}/", $payload), ExpenseData::class);

        event(new ExpensePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/expenses/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new ExpenseDestroyed(ExpenseData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
