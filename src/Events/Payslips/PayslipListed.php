<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipListed Event.
 *
 * Dispatched after a successful "Listed" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipListed extends WafeqEvent {}
