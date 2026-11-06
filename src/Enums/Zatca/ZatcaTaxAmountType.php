<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Whether every amount in a ZATCA document includes or excludes tax.
 */
enum ZatcaTaxAmountType: string
{
    case Exclusive = 'E';
    case Inclusive = 'I';
}
