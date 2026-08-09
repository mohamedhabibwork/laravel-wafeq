<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentListed Event.
 *
 * Dispatched after a successful "Listed" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentListed extends WafeqEvent {}
