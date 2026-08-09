<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteCreated Event.
 *
 * Dispatched after a successful "Created" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteCreated extends WafeqEvent {}
