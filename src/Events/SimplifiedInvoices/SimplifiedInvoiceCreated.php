<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceData $data
 *
 * SimplifiedInvoiceCreated Event.
 *
 * Dispatched after a successful "Created" call on the SimplifiedInvoices resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceCreated extends WafeqEvent {}
