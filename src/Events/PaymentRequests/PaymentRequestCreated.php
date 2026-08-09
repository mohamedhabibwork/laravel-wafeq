<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestCreated Event.
 *
 * Dispatched after a successful "Created" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestCreated extends WafeqEvent {}
