<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehousePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehousePartiallyUpdated extends WafeqEvent {}
