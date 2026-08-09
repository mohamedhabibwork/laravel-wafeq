<?php

namespace HWafeq\LaravelWafeq\Events\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property UnitOfMeasureData $data
 *
 * UnitOfMeasureCreated Event.
 *
 * Dispatched after a successful "Created" call on the UnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasureCreated extends WafeqEvent {}
