<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * EmployeesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface EmployeesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<EmployeeData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): EmployeeData;

    public function retrieve(string $id): EmployeeData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): EmployeeData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): EmployeeData;

    public function destroy(string $id): bool;
}
