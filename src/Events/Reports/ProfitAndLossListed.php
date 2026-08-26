<?php

namespace HWafeq\LaravelWafeq\Events\Reports;

use HWafeq\LaravelWafeq\Data\ProfitAndLossReportData;
use HWafeq\LaravelWafeq\Data\ReportListData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ReportListData $data
 *
 * ProfitAndLossListed Event.
 *
 * Dispatched after a successful `profitAndLoss()` call on the Reports
 * resource. `$data` wraps the array of {@see ProfitAndLossReportData}
 * envelopes returned by `/reports/profit-and-loss/`.
 *
 * @see LaravelWafeq
 */
class ProfitAndLossListed extends WafeqEvent {}
