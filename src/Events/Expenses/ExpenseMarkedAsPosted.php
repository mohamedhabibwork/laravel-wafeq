<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseMarkedAsPosted Event.
 *
 * Dispatched after a successful "Mark expense as posted" call on the Expenses
 * resource — posts a draft expense to the ledger (generates its journal).
 *
 * @see LaravelWafeq
 */
class ExpenseMarkedAsPosted extends WafeqEvent {}
