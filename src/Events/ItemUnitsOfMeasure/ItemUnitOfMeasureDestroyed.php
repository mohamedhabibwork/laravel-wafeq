<?php

namespace HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemUnitOfMeasureData $data
 *
 * ItemUnitOfMeasureDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the ItemUnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitOfMeasureDestroyed extends WafeqEvent {}
