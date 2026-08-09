<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems;

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderLineItemData $data
 *
 * PurchaseOrderLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the PurchaseOrdersLineItems resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderLineItemUpdated extends WafeqEvent {}
