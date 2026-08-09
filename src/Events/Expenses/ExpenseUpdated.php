<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpenseUpdated extends WafeqEvent {}
