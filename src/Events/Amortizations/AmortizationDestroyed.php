<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationDestroyed extends WafeqEvent {}
