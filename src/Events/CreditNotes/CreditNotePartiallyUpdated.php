<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNotePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNotePartiallyUpdated extends WafeqEvent {}
