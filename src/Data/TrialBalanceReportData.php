<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property TrialBalanceOverviewData $overview
 * @property DataCollection<int, mixed> $rows
 * @property TrialBalanceSummaryData $summary
 * @property array<string, mixed> $extra
 */
/**
 * TrialBalanceReportData Data Transfer Object.
 *
 * Single entry in the JSON array returned by `GET /reports/trial-balance/`.
 * Mirrors Wafeq's `api-v1-external-reports-trial-balance-grouped-read`
 * schema: an overview block, a nested `rows[]` of sections + leaf rows,
 * and a top-level summary holding {@see TrialBalanceTotalsData}.
 *
 * @see LaravelWafeq
 */
class TrialBalanceReportData extends Data
{
    /**
     * @param  DataCollection<int, mixed>|array<int, mixed>  $rows
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public TrialBalanceOverviewData $overview = new TrialBalanceOverviewData,
        public DataCollection|array $rows = [],
        public TrialBalanceSummaryData $summary = new TrialBalanceSummaryData,
        public array $extra = [],
    ) {}
}
