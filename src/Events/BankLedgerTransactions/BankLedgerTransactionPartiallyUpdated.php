<?php

namespace HWafeq\LaravelWafeq\Events\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankLedgerTransactionData $data
 *
 * BankLedgerTransactionPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the BankLedgerTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionPartiallyUpdated extends WafeqEvent {}
