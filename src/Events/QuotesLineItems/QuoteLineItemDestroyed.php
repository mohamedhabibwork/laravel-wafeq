<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemDestroyed extends WafeqEvent {}
