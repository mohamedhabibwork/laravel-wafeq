<?php

namespace HWafeq\LaravelWafeq\Events\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property RevenueRecognitionData $data
 *
 * RevenueRecognitionPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the RevenueRecognitions resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionPartiallyUpdated extends WafeqEvent {}
