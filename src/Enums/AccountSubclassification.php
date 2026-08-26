<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * AccountSubClassificationEnum mirrors the Wafeq `AccountSubClassificationEnum`
 * schema. Used for the `subclassification` field on the Account resource.
 *
 * @method static self Income()
 * @method static self OtherIncome()
 * @method static self Cogs()
 * @method static self OperatingExpense()
 * @method static self NonOperatingExpense()
 * @method static self CashEquivalents()
 * @method static self CurrentAsset()
 * @method static self NonCurrentAsset()
 * @method static self FixedAsset()
 * @method static self CurrentLiability()
 * @method static self NonCurrentLiability()
 * @method static self PaidInCapital()
 * @method static self RetainedEarnings()
 * @method static self AccumulatedOtherComprehensiveIncome()
 * @method static self TreasuryStock()
 * @method static self OwnersEquity()
 * @method static self OpeningBalanceEquity()
 *
 * @see LaravelWafeq
 */
enum AccountSubclassification: string
{
    case Income = 'INCOME';
    case OtherIncome = 'OTHER_INCOME';
    case Cogs = 'COGS';
    case OperatingExpense = 'OPERATING_EXPENSE';
    case NonOperatingExpense = 'NON_OPERATING_EXPENSE';
    case CashEquivalents = 'CASH_EQUIVALENTS';
    case CurrentAsset = 'CURRENT_ASSET';
    case NonCurrentAsset = 'NON_CURRENT_ASSET';
    case FixedAsset = 'FIXED_ASSET';
    case CurrentLiability = 'CURRENT_LIABILITY';
    case NonCurrentLiability = 'NON_CURRENT_LIABILITY';
    case PaidInCapital = 'PAID_IN_CAPITAL';
    case RetainedEarnings = 'RETAINED_EARNINGS';
    case AccumulatedOtherComprehensiveIncome = 'ACCUMULATED_OTHER_COMPREHENSIVE_INCOME';
    case TreasuryStock = 'TREASURY_STOCK';
    case OwnersEquity = 'OWNERS_EQUITY';
    case OpeningBalanceEquity = 'OPENING_BALANCE_EQUITY';
}
