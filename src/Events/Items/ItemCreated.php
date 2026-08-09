<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemCreated extends WafeqEvent {}
