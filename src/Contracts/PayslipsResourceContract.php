<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipData;
use Illuminate\Http\Client\Response;

/**
 * PayslipsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PayslipsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipData;

    public function retrieve(string $id): PayslipData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): PayslipData;

    public function retrieveModel(): PayslipData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): PayslipData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): PayslipData;

    public function destroyModel(): bool;
}
