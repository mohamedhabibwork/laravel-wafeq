<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property DataCollection<int, mixed>|array<int, mixed> $reports
 * @property array<string, mixed> $extra
 */
/**
 * ReportListData Data Transfer Object.
 *
 * Wrapper around a JSON array of typed report envelopes returned by
 * `/reports/*` endpoints. Carries the array of reports under a typed
 * property so the package's `WafeqEvent` base class (which requires a
 * `Spatie\LaravelData\Data` payload) can dispatch them.
 *
 * Use `$reports[0]` to access the first envelope (e.g. a
 * {@see BalanceSheetReportData}).
 *
 * @see LaravelWafeq
 */
class ReportListData extends Data
{
    /**
     * @param  DataCollection<int, mixed>|array<int, mixed>  $reports
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public DataCollection|array $reports = [],
        public array $extra = [],
    ) {}
}
