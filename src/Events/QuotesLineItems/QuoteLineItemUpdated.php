<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemUpdated extends WafeqEvent {}
