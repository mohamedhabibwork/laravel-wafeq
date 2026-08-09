<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderCreated Event.
 *
 * Dispatched after a successful "Created" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderCreated extends WafeqEvent {}
