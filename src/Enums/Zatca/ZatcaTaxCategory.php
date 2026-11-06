<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * UNTDID 5305 VAT category applied to a line, charge, discount or prepayment.
 *
 * Every category except `Standard` requires an exemption reason.
 */
enum ZatcaTaxCategory: string
{
    case Standard = 'S';
    case ZeroRated = 'Z';
    case Exempt = 'E';
    case OutOfScope = 'O';

    public function requiresExemptionReason(): bool
    {
        return $this !== self::Standard;
    }
}
