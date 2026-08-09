<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemListed extends WafeqEvent {}
