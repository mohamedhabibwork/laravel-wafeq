<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ProjectData;

/**
 * ProjectsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ProjectsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ProjectData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): ProjectData;

    public function retrieve(string $id): ProjectData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): ProjectData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): ProjectData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): ProjectData;

    public function retrieveModel(): ProjectData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): ProjectData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): ProjectData;

    public function destroyModel(): bool;
}
