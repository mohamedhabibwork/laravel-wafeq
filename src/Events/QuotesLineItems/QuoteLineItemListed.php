<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemListed extends WafeqEvent {}
