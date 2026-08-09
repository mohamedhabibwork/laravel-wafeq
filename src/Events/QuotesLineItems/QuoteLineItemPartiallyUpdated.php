<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemPartiallyUpdated extends WafeqEvent {}
