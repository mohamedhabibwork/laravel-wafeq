<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactRetrieved extends WafeqEvent {}
