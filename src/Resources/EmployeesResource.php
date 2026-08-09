<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithEmployeesModel;
use HWafeq\LaravelWafeq\Contracts\EmployeesResourceContract;
use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeCreated;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeDestroyed;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeListed;
use HWafeq\LaravelWafeq\Events\Employees\EmployeePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeRetrieved;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * EmployeesResource Resource.
 *
 * @see LaravelWafeq
 */
class EmployeesResource implements EmployeesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithEmployeesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<EmployeeData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/employees/', $query), EmployeeData::class);

        event(new EmployeeListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): EmployeeData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/employees/', $payload), EmployeeData::class);

        event(new EmployeeCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): EmployeeData
    {
        $data = $this->toData($this->http->get("/employees/{$id}/"), EmployeeData::class);

        event(new EmployeeRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): EmployeeData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/employees/{$id}/", $payload), EmployeeData::class);

        event(new EmployeeUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): EmployeeData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/employees/{$id}/", $payload), EmployeeData::class);

        event(new EmployeePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/employees/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new EmployeeDestroyed(EmployeeData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
