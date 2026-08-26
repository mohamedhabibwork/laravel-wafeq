<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * PayslipStatusEnum mirrors the Wafeq `PayslipStatusEnum` schema. Used for
 * the `status` field on the Payslip resource.
 *
 * @method static self Draft()
 * @method static self Posted()
 *
 * @see LaravelWafeq
 */
enum PayslipStatus: string
{
    case Draft = 'DRAFT';
    case Posted = 'POSTED';
}
