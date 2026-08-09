<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotesLineItems;

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteLineItemData $data
 *
 * DebitNoteLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the DebitNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemListed extends WafeqEvent {}
