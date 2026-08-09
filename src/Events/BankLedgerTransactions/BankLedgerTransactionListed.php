<?php

namespace HWafeq\LaravelWafeq\Events\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankLedgerTransactionData $data
 *
 * BankLedgerTransactionListed Event.
 *
 * Dispatched after a successful "Listed" call on the BankLedgerTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionListed extends WafeqEvent {}
