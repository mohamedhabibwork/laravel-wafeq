<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehouseUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehouseUpdated extends WafeqEvent {}
