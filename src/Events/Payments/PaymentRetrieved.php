<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentRetrieved extends WafeqEvent {}
