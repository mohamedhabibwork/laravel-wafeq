<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PaymentsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * PaymentsResource Resource.
 *
 * @see LaravelWafeq
 */
class PaymentsResource implements PaymentsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/payments/', $query), PaymentData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentData
    {
        return $this->toData($this->postIdempotent($this->http, '/payments/', $payload), PaymentData::class);
    }

    public function retrieve(string $id): PaymentData
    {
        return $this->toData($this->http->get("/payments/{$id}/"), PaymentData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentData
    {
        return $this->toData($this->putIdempotent($this->http, "/payments/{$id}/", $payload), PaymentData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentData
    {
        return $this->toData($this->patchIdempotent($this->http, "/payments/{$id}/", $payload), PaymentData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payments/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/payments/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }
}
