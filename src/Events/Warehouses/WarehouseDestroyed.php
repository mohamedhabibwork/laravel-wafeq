<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehouseDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehouseDestroyed extends WafeqEvent {}
