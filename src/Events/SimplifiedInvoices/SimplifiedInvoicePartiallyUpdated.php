<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceData $data
 *
 * SimplifiedInvoicePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the SimplifiedInvoices resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoicePartiallyUpdated extends WafeqEvent {}
