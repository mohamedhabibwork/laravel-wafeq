<?php

namespace HWafeq\LaravelWafeq\Events\Warehouses;

use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property WarehouseData $data
 *
 * WarehouseRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Warehouses resource.
 *
 * @see LaravelWafeq
 */
class WarehouseRetrieved extends WafeqEvent {}
