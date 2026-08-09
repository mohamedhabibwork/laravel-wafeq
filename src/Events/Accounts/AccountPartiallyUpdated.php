<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountPartiallyUpdated extends WafeqEvent {}
