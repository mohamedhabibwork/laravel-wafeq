<?php

namespace HWafeq\LaravelWafeq\Events\Reports;

use HWafeq\LaravelWafeq\Data\CashFlowReportData;
use HWafeq\LaravelWafeq\Data\ReportListData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ReportListData $data
 *
 * CashFlowListed Event.
 *
 * Dispatched after a successful `cashFlow()` call on the Reports
 * resource. `$data` wraps the array of {@see CashFlowReportData}
 * envelopes returned by `/reports/cash-flow/`.
 *
 * @see LaravelWafeq
 */
class CashFlowListed extends WafeqEvent {}
