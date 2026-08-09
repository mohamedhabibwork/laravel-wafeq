<?php

namespace HWafeq\LaravelWafeq\Events\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property RevenueRecognitionData $data
 *
 * RevenueRecognitionCreated Event.
 *
 * Dispatched after a successful "Created" call on the RevenueRecognitions resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionCreated extends WafeqEvent {}
