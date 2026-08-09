<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountListed Event.
 *
 * Dispatched after a successful "Listed" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountListed extends WafeqEvent {}
