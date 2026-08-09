<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipDestroyed extends WafeqEvent {}
