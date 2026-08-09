<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectCreated Event.
 *
 * Dispatched after a successful "Created" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectCreated extends WafeqEvent {}
