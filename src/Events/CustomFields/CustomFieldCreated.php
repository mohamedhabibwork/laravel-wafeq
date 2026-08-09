<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldCreated Event.
 *
 * Dispatched after a successful "Created" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldCreated extends WafeqEvent {}
