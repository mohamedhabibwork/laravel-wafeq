<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\TaxRateData;

/**
 * TaxRatesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface TaxRatesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<TaxRateData>
     */
    public function list(array $query = []): PaginatedData;

    public function retrieve(string $id): TaxRateData;
}
