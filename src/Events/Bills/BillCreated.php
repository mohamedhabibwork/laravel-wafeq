<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillCreated Event.
 *
 * Dispatched after a successful "Created" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillCreated extends WafeqEvent {}
