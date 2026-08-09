<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipUpdated extends WafeqEvent {}
