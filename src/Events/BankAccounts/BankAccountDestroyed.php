<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountDestroyed extends WafeqEvent {}
