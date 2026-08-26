<?php

namespace HWafeq\LaravelWafeq\Events\Reports;

use HWafeq\LaravelWafeq\Data\ReportListData;
use HWafeq\LaravelWafeq\Data\TrialBalanceReportData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ReportListData $data
 *
 * TrialBalanceListed Event.
 *
 * Dispatched after a successful `trialBalance()` call on the Reports
 * resource. `$data` wraps the array of {@see TrialBalanceReportData}
 * envelopes returned by `/reports/trial-balance/`.
 *
 * @see LaravelWafeq
 */
class TrialBalanceListed extends WafeqEvent {}
