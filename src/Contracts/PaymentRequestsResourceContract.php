<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentRequestData;

/**
 * PaymentRequestsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface PaymentRequestsResourceContract extends WafeqResourceWithModelMethods
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentRequestData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentRequestData;

    public function retrieve(string $id): PaymentRequestData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentRequestData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentRequestData;

    public function destroy(string $id): bool;

    /**
     * @param  array<string, mixed>  $extra
     */
    public function createFromModel(array $extra = []): PaymentRequestData;

    public function retrieveModel(): PaymentRequestData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateModel(array $payload): PaymentRequestData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdateModel(array $payload): PaymentRequestData;

    public function destroyModel(): bool;
}
