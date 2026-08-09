<?php

namespace HWafeq\LaravelWafeq\Events\CustomFields;

use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CustomFieldData $data
 *
 * CustomFieldListed Event.
 *
 * Dispatched after a successful "Listed" call on the CustomFields resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldListed extends WafeqEvent {}
