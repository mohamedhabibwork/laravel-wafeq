<?php

namespace HWafeq\LaravelWafeq\Events\Quotes;

use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property QuoteData $data
 *
 * QuoteDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the Quotes resource.
 *
 * @see LaravelWafeq
 */
class QuoteDownloaded extends WafeqEvent {}
