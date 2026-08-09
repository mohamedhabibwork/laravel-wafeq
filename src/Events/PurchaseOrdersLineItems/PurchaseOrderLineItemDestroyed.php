<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems;

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderLineItemData $data
 *
 * PurchaseOrderLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the PurchaseOrdersLineItems resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderLineItemDestroyed extends WafeqEvent {}
