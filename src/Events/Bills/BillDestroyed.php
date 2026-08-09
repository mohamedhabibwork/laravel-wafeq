<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillDestroyed extends WafeqEvent {}
