<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNoteListed Event.
 *
 * Dispatched after a successful "Listed" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteListed extends WafeqEvent {}
