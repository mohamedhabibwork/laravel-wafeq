<?php

namespace HWafeq\LaravelWafeq\Events\PaymentRequests;

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentRequestData $data
 *
 * PaymentRequestRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the PaymentRequests resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestRetrieved extends WafeqEvent {}
