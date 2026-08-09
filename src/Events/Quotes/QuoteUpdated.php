<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteUpdated extends WafeqEvent {}
