<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems;

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderLineItemData $data
 *
 * PurchaseOrderLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the PurchaseOrdersLineItems resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderLineItemPartiallyUpdated extends WafeqEvent {}
