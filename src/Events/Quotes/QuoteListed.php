<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteListed Event.
 *
 * Dispatched after a successful "Listed" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteListed extends WafeqEvent {}
