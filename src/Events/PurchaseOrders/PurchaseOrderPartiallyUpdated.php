<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderPartiallyUpdated extends WafeqEvent {}
