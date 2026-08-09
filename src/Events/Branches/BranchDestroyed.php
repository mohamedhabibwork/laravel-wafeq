<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchDestroyed extends WafeqEvent {}
