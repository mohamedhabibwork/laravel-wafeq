<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchCreated Event.
 *
 * Dispatched after a successful "Created" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchCreated extends WafeqEvent {}
