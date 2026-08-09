<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotesLineItems;

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteLineItemData $data
 *
 * DebitNoteLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the DebitNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemCreated extends WafeqEvent {}
