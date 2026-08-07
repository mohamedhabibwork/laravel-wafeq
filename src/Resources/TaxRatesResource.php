<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\TaxRatesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\TaxRateData;
use Illuminate\Http\Client\PendingRequest;

/**
 * TaxRatesResource Resource.
 *
 * @see LaravelWafeq
 */
class TaxRatesResource implements TaxRatesResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<TaxRateData>
     */
    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/tax-rates/', $query), TaxRateData::class);
    }

    public function retrieve(string $id): TaxRateData
    {
        return $this->toData($this->http->get("/tax-rates/{$id}/"), TaxRateData::class);
    }
}
