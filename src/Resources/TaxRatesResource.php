<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Contracts\TaxRatesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\TaxRateData;
use HWafeq\LaravelWafeq\Events\TaxRates\TaxRateListed;
use HWafeq\LaravelWafeq\Events\TaxRates\TaxRateRetrieved;
use Illuminate\Http\Client\PendingRequest;

/**
 * TaxRatesResource Resource.
 *
 * @see LaravelWafeq
 */
class TaxRatesResource implements TaxRatesResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<TaxRateData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/tax-rates/', $query), TaxRateData::class);

        event(new TaxRateListed($page, '', $query));

        return $page;
    }

    public function retrieve(string $id): TaxRateData
    {
        $data = $this->toData($this->http->get("/tax-rates/{$id}/"), TaxRateData::class);

        event(new TaxRateRetrieved($data, $id));

        return $data;
    }
}
