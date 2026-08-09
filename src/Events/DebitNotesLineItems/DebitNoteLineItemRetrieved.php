<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotesLineItems;

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteLineItemData $data
 *
 * DebitNoteLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the DebitNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemRetrieved extends WafeqEvent {}
