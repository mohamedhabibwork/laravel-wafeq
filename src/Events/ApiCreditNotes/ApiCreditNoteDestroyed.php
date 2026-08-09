<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNoteDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteDestroyed extends WafeqEvent {}
