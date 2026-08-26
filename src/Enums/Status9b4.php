<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Status9b4Enum mirrors the Wafeq `Status9b4Enum` schema. Used for the
 * `status` field on credit-note / debit-note resources.
 *
 * @method static self Draft()
 * @method static self Sent()
 *
 * @see LaravelWafeq
 */
enum Status9b4: string
{
    case Draft = 'DRAFT';
    case Sent = 'SENT';
}
