<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemListed extends WafeqEvent {}
