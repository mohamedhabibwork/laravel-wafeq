<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationCreated Event.
 *
 * Dispatched after a successful "Created" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationCreated extends WafeqEvent {}
