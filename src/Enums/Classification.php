<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Asset()
 * @method static self Liability()
 * @method static self Equity()
 * @method static self Revenue()
 * @method static self Expense()
 */
/**
 * Classification Enum.
 *
 * @see LaravelWafeq
 */
enum Classification: string
{
    case Asset = 'ASSET';
    case Liability = 'LIABILITY';
    case Equity = 'EQUITY';
    case Revenue = 'REVENUE';
    case Expense = 'EXPENSE';
}
