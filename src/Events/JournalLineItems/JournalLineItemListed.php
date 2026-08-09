<?php

namespace HWafeq\LaravelWafeq\Events\JournalLineItems;

use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property JournalLineItemData $data
 *
 * JournalLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the JournalLineItems resource.
 *
 * @see LaravelWafeq
 */
class JournalLineItemListed extends WafeqEvent {}
