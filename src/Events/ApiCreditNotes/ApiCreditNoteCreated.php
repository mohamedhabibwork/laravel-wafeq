<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNoteCreated Event.
 *
 * Dispatched after a successful "Created" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteCreated extends WafeqEvent {}
