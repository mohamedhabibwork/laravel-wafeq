<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * ClassificationEnum mirrors the Wafeq `ClassificationEnum` schema. Used for
 * the `classification` field on the Account resource.
 *
 * @method static self Revenue()
 * @method static self Expense()
 * @method static self Asset()
 * @method static self Bank()
 * @method static self Liability()
 * @method static self Equity()
 *
 * @see LaravelWafeq
 */
enum Classification: string
{
    case Revenue = 'REVENUE';
    case Expense = 'EXPENSE';
    case Asset = 'ASSET';
    case Bank = 'BANK';
    case Liability = 'LIABILITY';
    case Equity = 'EQUITY';
}
