<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactUpdated extends WafeqEvent {}
