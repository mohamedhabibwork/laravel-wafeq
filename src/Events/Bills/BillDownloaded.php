<?php

namespace HWafeq\LaravelWafeq\Events\Bills;

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BillData $data
 *
 * BillDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the Bills resource.
 *
 * @see LaravelWafeq
 */
class BillDownloaded extends WafeqEvent {}
