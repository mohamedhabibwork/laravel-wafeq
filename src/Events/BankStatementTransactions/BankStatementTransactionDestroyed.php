<?php

namespace HWafeq\LaravelWafeq\Events\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankStatementTransactionData $data
 *
 * BankStatementTransactionDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the BankStatementTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionDestroyed extends WafeqEvent {}
