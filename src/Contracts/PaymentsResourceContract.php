<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentData;
use Illuminate\Http\Client\Response;

/**
 * PaymentsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PaymentsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentData;

    public function retrieve(string $id): PaymentData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): PaymentData;

    public function retrieveModel(): PaymentData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): PaymentData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): PaymentData;

    public function destroyModel(): bool;
}
