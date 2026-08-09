<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentCreated Event.
 *
 * Dispatched after a successful "Created" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentCreated extends WafeqEvent {}
