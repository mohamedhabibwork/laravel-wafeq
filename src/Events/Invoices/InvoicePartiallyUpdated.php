<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoicePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoicePartiallyUpdated extends WafeqEvent {}
