<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property DataCollection<int, ReportColumnData> $columns
 * @property ProfitAndLossOverviewData $overview
 * @property DataCollection<int, mixed> $rows
 * @property array<string, mixed> $extra
 */
/**
 * ProfitAndLossReportData Data Transfer Object.
 *
 * Single entry in the JSON array returned by
 * `GET /reports/profit-and-loss/`. Mirrors Wafeq's
 * `api-v1-external-reports-profit-and-loss-read` schema.
 *
 * @see LaravelWafeq
 */
class ProfitAndLossReportData extends Data
{
    /**
     * @param  DataCollection<int, ReportColumnData>|array<int, ReportColumnData>  $columns
     * @param  DataCollection<int, mixed>|array<int, mixed>  $rows
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public DataCollection|array $columns = [],
        public ProfitAndLossOverviewData $overview = new ProfitAndLossOverviewData,
        public DataCollection|array $rows = [],
        public array $extra = [],
    ) {}
}
