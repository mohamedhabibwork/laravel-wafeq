<?php

namespace HWafeq\LaravelWafeq\Events\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property RevenueRecognitionData $data
 *
 * RevenueRecognitionDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the RevenueRecognitions resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionDestroyed extends WafeqEvent {}
