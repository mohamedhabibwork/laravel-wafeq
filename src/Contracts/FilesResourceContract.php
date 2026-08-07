<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * FilesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface FilesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<FileData>
     */
    public function list(array $query = []): PaginatedData;

    public function retrieve(string $id): FileData;

    public function destroy(string $id): bool;

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function upload(array $payload): FileData;

    /**
     * @param  array<int, array<string, mixed>>  $payload
     */
    public function uploadRaw(array $payload): FileData;
}
