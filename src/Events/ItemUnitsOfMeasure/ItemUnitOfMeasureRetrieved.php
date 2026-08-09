<?php

namespace HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemUnitOfMeasureData $data
 *
 * ItemUnitOfMeasureRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the ItemUnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitOfMeasureRetrieved extends WafeqEvent {}
