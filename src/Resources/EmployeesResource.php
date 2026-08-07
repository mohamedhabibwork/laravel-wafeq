<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\EmployeesResourceContract;
use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * EmployeesResource Resource.
 *
 * @see LaravelWafeq
 */
class EmployeesResource implements EmployeesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<EmployeeData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/employees/', $query), EmployeeData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): EmployeeData
    {
        return $this->toData($this->postIdempotent($this->http, '/employees/', $payload), EmployeeData::class);
    }

    public function retrieve(string $id): EmployeeData
    {
        return $this->toData($this->http->get("/employees/{$id}/"), EmployeeData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): EmployeeData
    {
        return $this->toData($this->putIdempotent($this->http, "/employees/{$id}/", $payload), EmployeeData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): EmployeeData
    {
        return $this->toData($this->patchIdempotent($this->http, "/employees/{$id}/", $payload), EmployeeData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/employees/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
