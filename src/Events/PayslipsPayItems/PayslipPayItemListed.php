<?php

namespace HWafeq\LaravelWafeq\Events\PayslipsPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipPayItemData $data
 *
 * PayslipPayItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the PayslipsPayItems resource.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemListed extends WafeqEvent {}
