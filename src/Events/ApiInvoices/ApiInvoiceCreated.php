<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceCreated Event.
 *
 * Dispatched after a successful "Created" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceCreated extends WafeqEvent {}
