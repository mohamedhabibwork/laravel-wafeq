<?php

namespace HWafeq\LaravelWafeq\Events\RevenueRecognitions;

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property RevenueRecognitionData $data
 *
 * RevenueRecognitionRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the RevenueRecognitions resource.
 *
 * @see LaravelWafeq
 */
class RevenueRecognitionRetrieved extends WafeqEvent {}
