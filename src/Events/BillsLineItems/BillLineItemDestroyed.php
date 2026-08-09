<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemDestroyed extends WafeqEvent {}
