<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotesLineItems;

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteLineItemData $data
 *
 * DebitNoteLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the DebitNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemPartiallyUpdated extends WafeqEvent {}
