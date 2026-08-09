<?php

namespace HWafeq\LaravelWafeq\Events\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property UnitOfMeasureData $data
 *
 * UnitOfMeasureListed Event.
 *
 * Dispatched after a successful "Listed" call on the UnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasureListed extends WafeqEvent {}
