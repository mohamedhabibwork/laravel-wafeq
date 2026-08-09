<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems;

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderLineItemData $data
 *
 * PurchaseOrderLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the PurchaseOrdersLineItems resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderLineItemListed extends WafeqEvent {}
