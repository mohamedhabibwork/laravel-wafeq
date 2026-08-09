<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectUpdated extends WafeqEvent {}
