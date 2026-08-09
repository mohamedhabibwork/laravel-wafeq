<?php

namespace HWafeq\LaravelWafeq\Events\Projects;

use HWafeq\LaravelWafeq\Data\ProjectData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ProjectData $data
 *
 * ProjectRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Projects resource.
 *
 * @see LaravelWafeq
 */
class ProjectRetrieved extends WafeqEvent {}
