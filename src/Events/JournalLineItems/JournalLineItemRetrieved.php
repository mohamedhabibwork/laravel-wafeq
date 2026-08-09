<?php

namespace HWafeq\LaravelWafeq\Events\JournalLineItems;

use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property JournalLineItemData $data
 *
 * JournalLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the JournalLineItems resource.
 *
 * @see LaravelWafeq
 */
class JournalLineItemRetrieved extends WafeqEvent {}
