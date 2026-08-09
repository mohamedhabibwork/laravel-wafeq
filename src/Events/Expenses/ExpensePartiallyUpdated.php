<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpensePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpensePartiallyUpdated extends WafeqEvent {}
