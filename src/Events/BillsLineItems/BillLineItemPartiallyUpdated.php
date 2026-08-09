<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemPartiallyUpdated extends WafeqEvent {}
