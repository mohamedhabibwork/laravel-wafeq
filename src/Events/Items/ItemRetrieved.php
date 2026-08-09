<?php

namespace HWafeq\LaravelWafeq\Events\Items;

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ItemData $data
 *
 * ItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Items resource.
 *
 * @see LaravelWafeq
 */
class ItemRetrieved extends WafeqEvent {}
