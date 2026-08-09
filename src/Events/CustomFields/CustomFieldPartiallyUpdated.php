<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldPartiallyUpdated extends WafeqEvent {}
