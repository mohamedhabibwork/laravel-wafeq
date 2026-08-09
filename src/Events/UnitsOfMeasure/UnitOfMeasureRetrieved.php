<?php

namespace HWafeq\LaravelWafeq\Events\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property UnitOfMeasureData $data
 *
 * UnitOfMeasureRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the UnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasureRetrieved extends WafeqEvent {}
