<?php

namespace HWafeq\LaravelWafeq\Events\TaxRates;

use HWafeq\LaravelWafeq\Data\TaxRateData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property TaxRateData $data
 *
 * TaxRateListed Event.
 *
 * Dispatched after a successful "Listed" call on the TaxRates resource.
 *
 * @see LaravelWafeq
 */
class TaxRateListed extends WafeqEvent {}
