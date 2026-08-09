<?php

namespace HWafeq\LaravelWafeq\Events\Payments;

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PaymentData $data
 *
 * PaymentDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the Payments resource.
 *
 * @see LaravelWafeq
 */
class PaymentDownloaded extends WafeqEvent {}
