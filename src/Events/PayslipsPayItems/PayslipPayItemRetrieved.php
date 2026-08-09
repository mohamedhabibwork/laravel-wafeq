<?php

namespace HWafeq\LaravelWafeq\Events\PayslipsPayItems;

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PayslipPayItemData $data
 *
 * PayslipPayItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the PayslipsPayItems resource.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemRetrieved extends WafeqEvent {}
