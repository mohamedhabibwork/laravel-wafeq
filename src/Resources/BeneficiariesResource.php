<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithBeneficiariesModel;
use HWafeq\LaravelWafeq\Contracts\BeneficiariesResourceContract;
use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryCreated;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryDestroyed;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryListed;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryRetrieved;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * BeneficiariesResource Resource.
 *
 * @see LaravelWafeq
 */
class BeneficiariesResource implements BeneficiariesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithBeneficiariesModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<BeneficiaryData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/beneficiaries/', $query), BeneficiaryData::class);

        event(new BeneficiaryListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): BeneficiaryData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/beneficiaries/', $payload), BeneficiaryData::class);

        event(new BeneficiaryCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): BeneficiaryData
    {
        $data = $this->toData($this->http->get("/beneficiaries/{$id}/"), BeneficiaryData::class);

        event(new BeneficiaryRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): BeneficiaryData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/beneficiaries/{$id}/", $payload), BeneficiaryData::class);

        event(new BeneficiaryUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): BeneficiaryData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/beneficiaries/{$id}/", $payload), BeneficiaryData::class);

        event(new BeneficiaryPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/beneficiaries/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new BeneficiaryDestroyed(BeneficiaryData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
