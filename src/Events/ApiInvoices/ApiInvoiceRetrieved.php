<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceRetrieved extends WafeqEvent {}
