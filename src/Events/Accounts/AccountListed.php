<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountListed Event.
 *
 * Dispatched after a successful "Listed" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountListed extends WafeqEvent {}
