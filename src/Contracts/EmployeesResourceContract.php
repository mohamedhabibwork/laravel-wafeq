<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * EmployeesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface EmployeesResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): EmployeeData;

    public function retrieveModel(): EmployeeData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): EmployeeData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): EmployeeData;

    public function destroyModel(): bool;
}
