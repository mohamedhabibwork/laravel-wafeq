<?php

namespace HWafeq\LaravelWafeq\Events\Amortizations;

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AmortizationData $data
 *
 * AmortizationRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Amortizations resource.
 *
 * @see LaravelWafeq
 */
class AmortizationRetrieved extends WafeqEvent {}
