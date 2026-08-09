<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteListed Event.
 *
 * Dispatched after a successful "Listed" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteListed extends WafeqEvent {}
