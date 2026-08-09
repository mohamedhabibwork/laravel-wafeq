<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceListed Event.
 *
 * Dispatched after a successful "Listed" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceListed extends WafeqEvent {}
