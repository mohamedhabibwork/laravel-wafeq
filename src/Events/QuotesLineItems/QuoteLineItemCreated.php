<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemCreated extends WafeqEvent {}
