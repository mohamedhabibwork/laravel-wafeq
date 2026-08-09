<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestListed Event.
 *
 * Dispatched after a successful "Listed" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestListed extends WafeqEvent {}
