<?php

namespace HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemUnitOfMeasureData $data
 *
 * ItemUnitOfMeasureCreated Event.
 *
 * Dispatched after a successful "Created" call on the ItemUnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitOfMeasureCreated extends WafeqEvent {}
