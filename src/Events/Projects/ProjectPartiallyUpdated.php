<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectPartiallyUpdated extends WafeqEvent {}
