<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountRetrieved extends WafeqEvent {}
