<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PaymentRequestsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use Illuminate\Http\Client\PendingRequest;

/**
 * PaymentRequestsResource Resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestsResource implements PaymentRequestsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentRequestData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/payment-requests/', $query), PaymentRequestData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentRequestData
    {
        return $this->toData($this->postIdempotent($this->http, '/payment-requests/', $payload), PaymentRequestData::class);
    }

    public function retrieve(string $id): PaymentRequestData
    {
        return $this->toData($this->http->get("/payment-requests/{$id}/"), PaymentRequestData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentRequestData
    {
        return $this->toData($this->putIdempotent($this->http, "/payment-requests/{$id}/", $payload), PaymentRequestData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentRequestData
    {
        return $this->toData($this->patchIdempotent($this->http, "/payment-requests/{$id}/", $payload), PaymentRequestData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payment-requests/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
