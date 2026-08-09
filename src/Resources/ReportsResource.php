<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Contracts\ReportsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ReportRowData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ReportsResource Resource.
 *
 * @see LaravelWafeq
 */
class ReportsResource implements ReportsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function balanceSheet(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/reports/balance-sheet/', $query), ReportRowData::class);
    }

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function cashFlow(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/reports/cash-flow/', $query), ReportRowData::class);
    }

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function profitAndLoss(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/reports/profit-and-loss/', $query), ReportRowData::class);
    }

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function trialBalance(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get('/reports/trial-balance/', $query), ReportRowData::class);
    }
}
