<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrders;

use HWafeq\LaravelWafeq\Data\PurchaseOrderData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderData $data
 *
 * PurchaseOrderDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the PurchaseOrders resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderDownloaded extends WafeqEvent {}
