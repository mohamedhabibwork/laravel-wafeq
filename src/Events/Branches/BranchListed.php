<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchListed Event.
 *
 * Dispatched after a successful "Listed" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchListed extends WafeqEvent {}
