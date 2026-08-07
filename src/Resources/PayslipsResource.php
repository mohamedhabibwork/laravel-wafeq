<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\PayslipsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * PayslipsResource Resource.
 *
 * @see LaravelWafeq
 */
class PayslipsResource implements PayslipsResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/payslips/', $query), PayslipData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipData
    {
        return $this->toData($this->postIdempotent($this->http, '/payslips/', $payload), PayslipData::class);
    }

    public function retrieve(string $id): PayslipData
    {
        return $this->toData($this->http->get("/payslips/{$id}/"), PayslipData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipData
    {
        return $this->toData($this->putIdempotent($this->http, "/payslips/{$id}/", $payload), PayslipData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipData
    {
        return $this->toData($this->patchIdempotent($this->http, "/payslips/{$id}/", $payload), PayslipData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payslips/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/payslips/{$id}/download/");
        $this->guardResponse($response);

        return $response;
    }
}
