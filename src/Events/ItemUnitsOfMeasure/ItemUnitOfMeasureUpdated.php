<?php

namespace HWafeq\LaravelWafeq\Events\ItemUnitsOfMeasure;

use HWafeq\LaravelWafeq\Data\ItemUnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemUnitOfMeasureData $data
 *
 * ItemUnitOfMeasureUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the ItemUnitsOfMeasure resource.
 *
 * @see LaravelWafeq
 */
class ItemUnitOfMeasureUpdated extends WafeqEvent {}
