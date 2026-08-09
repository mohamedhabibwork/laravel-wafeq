<?php

namespace HWafeq\LaravelWafeq\Events\Payslips;

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipData $data
 *
 * PayslipRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Payslips resource.
 *
 * @see LaravelWafeq
 */
class PayslipRetrieved extends WafeqEvent {}
