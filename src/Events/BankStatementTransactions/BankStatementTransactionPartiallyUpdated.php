<?php

namespace HWafeq\LaravelWafeq\Events\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankStatementTransactionData $data
 *
 * BankStatementTransactionPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the BankStatementTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionPartiallyUpdated extends WafeqEvent {}
