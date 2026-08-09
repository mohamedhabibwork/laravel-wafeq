<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemUpdated extends WafeqEvent {}
