<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationPartiallyUpdated extends WafeqEvent {}
