<?php

namespace HWafeq\LaravelWafeq\Events\PayslipsPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipPayItemData $data
 *
 * PayslipPayItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the PayslipsPayItems resource.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemDestroyed extends WafeqEvent {}
