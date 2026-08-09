<?php

namespace HWafeq\LaravelWafeq\Events\TaxRates;

use HWafeq\LaravelWafeq\Data\TaxRateData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property TaxRateData $data
 *
 * TaxRateRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the TaxRates resource.
 *
 * @see LaravelWafeq
 */
class TaxRateRetrieved extends WafeqEvent {}
