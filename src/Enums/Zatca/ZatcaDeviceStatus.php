<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Enrollment state of a ZATCA device (solution unit).
 */
enum ZatcaDeviceStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Failed = 'failed';
    case Revoked = 'revoked';
}
