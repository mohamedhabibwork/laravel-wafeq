<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * ChargeTypeEnum mirrors the Wafeq `ChargeTypeEnum` schema. Used for the
 * `charge_type` field on payment-charge resources (Ours / Beneficiary / Shared).
 *
 * @method static self Our()
 * @method static self Beneficiary()
 * @method static self Shared()
 *
 * @see LaravelWafeq
 */
enum ChargeType: string
{
    case Our = 'OUR';
    case Beneficiary = 'BEN';
    case Shared = 'SHA';
}
