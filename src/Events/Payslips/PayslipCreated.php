<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipCreated Event.
 *
 * Dispatched after a successful "Created" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipCreated extends WafeqEvent {}
