<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillListed Event.
 *
 * Dispatched after a successful "Listed" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillListed extends WafeqEvent {}
