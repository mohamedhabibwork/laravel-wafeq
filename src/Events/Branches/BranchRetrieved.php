<?php

namespace HWafeq\LaravelWafeq\Events\Branches;

use HWafeq\LaravelWafeq\Data\BranchData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BranchData $data
 *
 * BranchRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Branches resource.
 *
 * @see LaravelWafeq
 */
class BranchRetrieved extends WafeqEvent {}
