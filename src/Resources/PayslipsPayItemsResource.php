<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PayslipsPayItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use Illuminate\Http\Client\PendingRequest;

/**
 * PayslipsPayItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class PayslipsPayItemsResource implements PayslipsPayItemsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipPayItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/payslips/pay-items/', $query), PayslipPayItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipPayItemData
    {
        return $this->toData($this->postIdempotent($this->http, '/payslips/pay-items/', $payload), PayslipPayItemData::class);
    }

    public function retrieve(string $id): PayslipPayItemData
    {
        return $this->toData($this->http->get("/payslips/pay-items/{$id}/"), PayslipPayItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipPayItemData
    {
        return $this->toData($this->putIdempotent($this->http, "/payslips/pay-items/{$id}/", $payload), PayslipPayItemData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipPayItemData
    {
        return $this->toData($this->patchIdempotent($this->http, "/payslips/pay-items/{$id}/", $payload), PayslipPayItemData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payslips/pay-items/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
