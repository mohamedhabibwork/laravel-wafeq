<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpenseRetrieved extends WafeqEvent {}
