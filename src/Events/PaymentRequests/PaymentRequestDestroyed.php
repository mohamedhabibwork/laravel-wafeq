<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestDestroyed extends WafeqEvent {}
