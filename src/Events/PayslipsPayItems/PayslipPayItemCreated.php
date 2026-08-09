<?php

namespace HWafeq\LaravelWafeq\Events\PayslipsPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipPayItemData $data
 *
 * PayslipPayItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the PayslipsPayItems resource.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemCreated extends WafeqEvent {}
