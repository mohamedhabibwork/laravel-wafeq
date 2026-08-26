<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property DataCollection<int, ReportColumnData> $columns
 * @property CashFlowOverviewData $overview
 * @property DataCollection<int, mixed> $rows
 * @property array<string, mixed> $extra
 */
/**
 * CashFlowReportData Data Transfer Object.
 *
 * Single entry in the JSON array returned by `GET /reports/cash-flow/`.
 * Mirrors Wafeq's `api-v1-external-reports-cash-flow-read` schema:
 * column descriptors, a {@see CashFlowOverviewData} block, and a nested
 * `rows[]` tree of sections + leaf rows.
 *
 * @see LaravelWafeq
 */
class CashFlowReportData extends Data
{
    /**
     * @param  DataCollection<int, ReportColumnData>|array<int, ReportColumnData>  $columns
     * @param  DataCollection<int, mixed>|array<int, mixed>  $rows
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public DataCollection|array $columns = [],
        public CashFlowOverviewData $overview = new CashFlowOverviewData,
        public DataCollection|array $rows = [],
        public array $extra = [],
    ) {}
}
