<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;

/**
 * RevenueRecognitionsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface RevenueRecognitionsResourceContract extends WafeqResourceWithModelMethods
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

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): RevenueRecognitionData;

    public function retrieveModel(): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): RevenueRecognitionData;

    public function destroyModel(): bool;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarlyModel(array $payload = []): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreateFromModel(array $payload = []): RevenueRecognitionData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarlyModel(array $payload = []): RevenueRecognitionData;
}
