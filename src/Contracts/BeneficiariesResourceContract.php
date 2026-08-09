<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Data\PaginatedData;

/**
 * BeneficiariesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface BeneficiariesResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BeneficiaryData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BeneficiaryData;

    public function retrieve(string $id): BeneficiaryData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BeneficiaryData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BeneficiaryData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): BeneficiaryData;

    public function retrieveModel(): BeneficiaryData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): BeneficiaryData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): BeneficiaryData;

    public function destroyModel(): bool;
}
