<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * AmortizationsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface AmortizationsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AmortizationData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AmortizationData;

    public function retrieve(string $id): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AmortizationData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreate(array $payload): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarly(string $id, array $payload = []): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarly(string $id, array $payload = []): AmortizationData;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): AmortizationData;

    public function retrieveModel(): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): AmortizationData;

    public function destroyModel(): bool;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarlyModel(array $payload = []): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreateFromModel(array $payload = []): AmortizationData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarlyModel(array $payload = []): AmortizationData;
}
