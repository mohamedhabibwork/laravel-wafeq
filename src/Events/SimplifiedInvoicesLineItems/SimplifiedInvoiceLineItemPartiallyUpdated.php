<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceLineItemData $data
 *
 * SimplifiedInvoiceLineItemPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the SimplifiedInvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceLineItemPartiallyUpdated extends WafeqEvent {}
