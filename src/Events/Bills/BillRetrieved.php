<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillRetrieved extends WafeqEvent {}
