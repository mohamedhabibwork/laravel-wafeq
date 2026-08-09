<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemPartiallyUpdated extends WafeqEvent {}
