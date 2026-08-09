<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteRetrieved extends WafeqEvent {}
