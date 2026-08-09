<?php

namespace HWafeq\LaravelWafeq\Events\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property RevenueRecognitionData $data
 *
 * RevenueRecognitionListed Event.
 *
 * Dispatched after a successful "Listed" call on the RevenueRecognitions resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionListed extends WafeqEvent {}
