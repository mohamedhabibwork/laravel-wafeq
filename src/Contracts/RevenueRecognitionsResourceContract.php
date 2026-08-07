<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;

/**
 * RevenueRecognitionsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface RevenueRecognitionsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<RevenueRecognitionData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): RevenueRecognitionData;

    public function retrieve(string $id): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): RevenueRecognitionData;

    public function destroy(string $id): bool;
}
