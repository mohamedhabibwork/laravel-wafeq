<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotesLineItems;

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteLineItemData $data
 *
 * DebitNoteLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the DebitNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemUpdated extends WafeqEvent {}
