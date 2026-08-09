<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldDestroyed extends WafeqEvent {}
