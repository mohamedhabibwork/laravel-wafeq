<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillPartiallyUpdated extends WafeqEvent {}
