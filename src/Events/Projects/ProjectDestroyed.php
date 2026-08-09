<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectDestroyed extends WafeqEvent {}
