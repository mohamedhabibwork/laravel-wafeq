<?php

namespace HWafeq\LaravelWafeq\Events\QuotesLineItems;

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteLineItemData $data
 *
 * QuoteLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the QuotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class QuoteLineItemRetrieved extends WafeqEvent {}
