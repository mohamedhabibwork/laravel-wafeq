<?php

namespace HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemUnitOfMeasureData $data
 *
 * ItemUnitOfMeasurePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the ItemUnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitOfMeasurePartiallyUpdated extends WafeqEvent {}
