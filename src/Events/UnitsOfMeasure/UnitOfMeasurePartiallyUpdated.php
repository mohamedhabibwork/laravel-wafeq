<?php

namespace HWafeq\LaravelWafeq\Events\UnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property UnitOfMeasureData $data
 *
 * UnitOfMeasurePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the UnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasurePartiallyUpdated extends WafeqEvent {}
