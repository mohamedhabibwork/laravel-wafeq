<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteRetrieved extends WafeqEvent {}
