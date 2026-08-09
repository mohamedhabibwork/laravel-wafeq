<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactCreated Event.
 *
 * Dispatched after a successful "Created" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactCreated extends WafeqEvent {}
