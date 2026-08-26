<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property DataCollection<int, ReportColumnData> $columns
 * @property BalanceSheetOverviewData $overview
 * @property DataCollection<int, mixed> $rows
 * @property array<string, mixed> $extra
 */
/**
 * BalanceSheetReportData Data Transfer Object.
 *
 * Single entry in the JSON array returned by `GET /reports/balance-sheet/`.
 * Mirrors Wafeq's `api-v1-external-reports-balance-sheet-read` schema:
 * a set of column descriptors, an overview block (currency, date,
 * period count, …) and a deeply nested `rows[]` of sections /
 * sub-sections / leaf rows.
 *
 * The `rows` collection is typed as `DataCollection<int, mixed>` because
 * each report mixes `section-read`, `subsection-read` and `data-read`
 * shapes; use {@see ReportRowData::from()} for leaf rows and read
 * `$extra` for the raw payload if you need every detail.
 *
 * @see LaravelWafeq
 */
class BalanceSheetReportData extends Data
{
    /**
     * @param  DataCollection<int, ReportColumnData>|array<int, ReportColumnData>  $columns
     * @param  DataCollection<int, mixed>|array<int, mixed>  $rows
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public DataCollection|array $columns = [],
        public BalanceSheetOverviewData $overview = new BalanceSheetOverviewData,
        public DataCollection|array $rows = [],
        public array $extra = [],
    ) {}
}
