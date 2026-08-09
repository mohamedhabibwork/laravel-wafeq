<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectListed Event.
 *
 * Dispatched after a successful "Listed" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectListed extends WafeqEvent {}
