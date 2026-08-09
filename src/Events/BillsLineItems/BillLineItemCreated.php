<?php

namespace HWafeq\LaravelWafeq\Events\BillsLineItems;

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillLineItemData $data
 *
 * BillLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the BillsLineItems resource.
 *
 * @see LaravelWafeq
 */
class BillLineItemCreated extends WafeqEvent {}
