<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehouseListed Event.
 *
 * Dispatched after a successful "Listed" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehouseListed extends WafeqEvent {}
