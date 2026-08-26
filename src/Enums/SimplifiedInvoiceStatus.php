<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * SimplifiedInvoiceStatusEnum mirrors the Wafeq `SimplifiedInvoiceStatusEnum`
 * schema. Used for the `status` field on the SimplifiedInvoice resource.
 *
 * @method static self Draft()
 * @method static self Paid()
 *
 * @see LaravelWafeq
 */
enum SimplifiedInvoiceStatus: string
{
    case Draft = 'DRAFT';
    case Paid = 'PAID';
}
