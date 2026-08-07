<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Email()
 * @method static self Sms()
 * @method static self Whatsapp()
 * @method static self Portal()
 */
/**
 * Medium Enum.
 *
 * @see LaravelWafeq
 */
enum Medium: string
{
    case Email = 'email';
    case Sms = 'sms';
    case Whatsapp = 'whatsapp';
    case Portal = 'portal';
}
