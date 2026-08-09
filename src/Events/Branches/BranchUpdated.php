<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchUpdated extends WafeqEvent {}
