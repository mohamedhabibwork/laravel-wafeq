<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationUpdated extends WafeqEvent {}
