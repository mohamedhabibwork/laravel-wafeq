<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * How close the organisation is to running out of ZATCA document credits.
 */
enum ZatcaWalletBalance: string
{
    case Low = 'LOW';
    case Ok = 'OK';
    case Out = 'OUT';
}
