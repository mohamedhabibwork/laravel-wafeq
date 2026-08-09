<?php

namespace HWafeq\LaravelWafeq\Events\InvoicesLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceLineItemData $data
 *
 * InvoiceLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the InvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class InvoiceLineItemPartiallyUpdated extends WafeqEvent {}
