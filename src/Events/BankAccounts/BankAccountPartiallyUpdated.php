<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountPartiallyUpdated extends WafeqEvent {}
