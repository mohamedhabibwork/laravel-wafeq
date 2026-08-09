<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentDestroyed extends WafeqEvent {}
