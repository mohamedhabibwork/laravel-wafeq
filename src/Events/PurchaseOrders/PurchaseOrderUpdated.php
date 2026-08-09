<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderUpdated extends WafeqEvent {}
