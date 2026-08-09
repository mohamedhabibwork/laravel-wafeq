<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNotePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNotePartiallyUpdated extends WafeqEvent {}
