<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentPartiallyUpdated extends WafeqEvent {}
