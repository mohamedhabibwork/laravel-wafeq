<?php

namespace HWafeq\LaravelWafeq\Events\PayslipsPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipPayItemData $data
 *
 * PayslipPayItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the PayslipsPayItems resource.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemPartiallyUpdated extends WafeqEvent {}
