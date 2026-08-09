<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipDownloaded extends WafeqEvent {}
