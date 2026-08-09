<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentUpdated extends WafeqEvent {}
