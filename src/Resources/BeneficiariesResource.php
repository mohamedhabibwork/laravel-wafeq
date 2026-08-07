<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\BeneficiariesResourceContract;
use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\PendingRequest;

/**
 * BeneficiariesResource Resource.
 *
 * @see LaravelWafeq
 */
class BeneficiariesResource implements BeneficiariesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BeneficiaryData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/beneficiaries/', $query), BeneficiaryData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BeneficiaryData
    {
        return $this->toData($this->postIdempotent($this->http, '/beneficiaries/', $payload), BeneficiaryData::class);
    }

    public function retrieve(string $id): BeneficiaryData
    {
        return $this->toData($this->http->get("/beneficiaries/{$id}/"), BeneficiaryData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BeneficiaryData
    {
        return $this->toData($this->putIdempotent($this->http, "/beneficiaries/{$id}/", $payload), BeneficiaryData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BeneficiaryData
    {
        return $this->toData($this->patchIdempotent($this->http, "/beneficiaries/{$id}/", $payload), BeneficiaryData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/beneficiaries/{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
