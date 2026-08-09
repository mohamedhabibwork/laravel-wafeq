<?php

namespace HWafeq\LaravelWafeq\Events\InvoicesLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceLineItemData $data
 *
 * InvoiceLineItemListed Event.
 *
 * Dispatched after a successful "Listed" call on the InvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class InvoiceLineItemListed extends WafeqEvent {}
