<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemDestroyed extends WafeqEvent {}
