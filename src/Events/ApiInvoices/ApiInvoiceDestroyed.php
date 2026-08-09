<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceDestroyed extends WafeqEvent {}
