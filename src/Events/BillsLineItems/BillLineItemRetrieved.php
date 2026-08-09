<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemRetrieved extends WafeqEvent {}
