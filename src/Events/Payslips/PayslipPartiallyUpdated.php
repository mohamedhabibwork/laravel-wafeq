<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipPartiallyUpdated extends WafeqEvent {}
