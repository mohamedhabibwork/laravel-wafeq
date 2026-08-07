<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ProjectData;

/**
 * ProjectsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ProjectsResourceContract extends ResourceContract
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
}
