<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeePartiallyUpdated extends WafeqEvent {}
