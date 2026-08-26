<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * BillStatusEnum mirrors the Wafeq `BillStatusEnum` schema. Used for the
 * `status` field on the Bill resource.
 *
 * @method static self Draft()
 * @method static self Authorized()
 * @method static self Paid()
 *
 * @see LaravelWafeq
 */
enum BillStatus: string
{
    case Draft = 'DRAFT';
    case Authorized = 'AUTHORIZED';
    case Paid = 'PAID';
}
