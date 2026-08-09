<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldUpdated extends WafeqEvent {}
