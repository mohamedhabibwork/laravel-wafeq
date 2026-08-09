<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestPartiallyUpdated extends WafeqEvent {}
