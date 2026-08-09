<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationListed Event.
 *
 * Dispatched after a successful "Listed" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationListed extends WafeqEvent {}
