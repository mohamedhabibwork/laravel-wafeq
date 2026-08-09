<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotesLineItems;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteLineItemData $data
 *
 * CreditNoteLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the CreditNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteLineItemListed extends WafeqEvent {}
