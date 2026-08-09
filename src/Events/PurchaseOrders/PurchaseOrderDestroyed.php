<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderDestroyed extends WafeqEvent {}
