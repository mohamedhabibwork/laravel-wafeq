<?php

namespace HWafeq\LaravelWafeq\Events\Reports;

use HWafeq\LaravelWafeq\Data\BalanceSheetReportData;
use HWafeq\LaravelWafeq\Data\ReportListData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ReportListData $data
 *
 * BalanceSheetListed Event.
 *
 * Dispatched after a successful `balanceSheet()` call on the Reports
 * resource. `$data` wraps the array of {@see BalanceSheetReportData}
 * envelopes returned by `/reports/balance-sheet/`.
 *
 * @see LaravelWafeq
 */
class BalanceSheetListed extends WafeqEvent {}
