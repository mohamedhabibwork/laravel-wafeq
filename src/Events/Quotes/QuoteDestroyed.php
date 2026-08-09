<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteDestroyed extends WafeqEvent {}
