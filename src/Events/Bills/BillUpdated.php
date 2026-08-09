<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillUpdated extends WafeqEvent {}
