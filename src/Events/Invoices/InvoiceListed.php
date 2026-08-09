<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceListed Event.
 *
 * Dispatched after a successful "Listed" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceListed extends WafeqEvent {}
