<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderRetrieved extends WafeqEvent {}
