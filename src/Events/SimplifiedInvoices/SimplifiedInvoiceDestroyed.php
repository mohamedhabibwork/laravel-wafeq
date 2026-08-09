<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceData $data
 *
 * SimplifiedInvoiceDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the SimplifiedInvoices resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceDestroyed extends WafeqEvent {}
