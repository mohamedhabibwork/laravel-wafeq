<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehouseCreated Event.
 *
 * Dispatched after a successful "Created" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehouseCreated extends WafeqEvent {}
