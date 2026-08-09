<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldRetrieved extends WafeqEvent {}
