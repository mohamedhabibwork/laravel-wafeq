<?php

namespace HWafeq\LaravelWafeq\Events\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankLedgerTransactionData $data
 *
 * BankLedgerTransactionDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the BankLedgerTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionDestroyed extends WafeqEvent {}
