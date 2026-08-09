<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchPartiallyUpdated extends WafeqEvent {}
