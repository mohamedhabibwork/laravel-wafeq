<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\ReportRowData;

/**
 * ReportsResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface ReportsResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function balanceSheet(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function cashFlow(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function profitAndLoss(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<ReportRowData>
     */
    public function trialBalance(array $query = []): PaginatedData;
}
