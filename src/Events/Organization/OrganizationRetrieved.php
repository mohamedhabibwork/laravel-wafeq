<?php

namespace HWafeq\LaravelWafeq\Events\Organization;

use HWafeq\LaravelWafeq\Data\OrganizationData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property OrganizationData $data
 *
 * OrganizationRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Organization resource.
 *
 * @see LaravelWafeq
 */
class OrganizationRetrieved extends WafeqEvent {}
