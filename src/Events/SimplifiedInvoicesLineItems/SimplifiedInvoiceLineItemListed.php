<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceLineItemData $data
 *
 * SimplifiedInvoiceLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the SimplifiedInvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceLineItemListed extends WafeqEvent {}
