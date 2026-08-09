<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestUpdated extends WafeqEvent {}
