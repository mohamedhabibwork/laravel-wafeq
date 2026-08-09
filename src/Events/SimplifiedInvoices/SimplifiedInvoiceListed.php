<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceData $data
 *
 * SimplifiedInvoiceListed Event.
 *
 * Dispatched after a successful "Listed" call on the SimplifiedInvoices resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceListed extends WafeqEvent {}
