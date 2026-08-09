<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemUpdated extends WafeqEvent {}
