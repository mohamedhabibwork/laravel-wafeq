<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotesLineItems;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteLineItemData $data
 *
 * CreditNoteLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the CreditNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteLineItemPartiallyUpdated extends WafeqEvent {}
