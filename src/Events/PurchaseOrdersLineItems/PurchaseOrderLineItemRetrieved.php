<?php

namespace HWafeq\LaravelWafeq\Events\PurchaseOrdersLineItems;

use HWafeq\LaravelWafeq\Data\PurchaseOrderLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property PurchaseOrderLineItemData $data
 *
 * PurchaseOrderLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the PurchaseOrdersLineItems resource.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderLineItemRetrieved extends WafeqEvent {}
