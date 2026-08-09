<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNoteRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteRetrieved extends WafeqEvent {}
