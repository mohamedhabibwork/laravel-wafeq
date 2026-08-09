<?php

namespace HWafeq\LaravelWafeq\Events\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property UnitOfMeasureData $data
 *
 * UnitOfMeasureDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the UnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasureDestroyed extends WafeqEvent {}
