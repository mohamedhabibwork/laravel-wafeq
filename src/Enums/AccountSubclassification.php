<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Bank()
 * @method static self AccountsReceivable()
 * @method static self OtherCurrentAsset()
 * @method static self FixedAsset()
 * @method static self OtherAsset()
 * @method static self AccountsPayable()
 * @method static self CreditCard()
 * @method static self OtherCurrentLiability()
 * @method static self LongTermLiability()
 * @method static self Equity()
 * @method static self Income()
 * @method static self OtherIncome()
 * @method static self CostOfGoodsSold()
 * @method static self Expense()
 * @method static self OtherExpense()
 * @method static self NonPosting()
 */
/**
 * AccountSubclassification Enum.
 *
 * @see LaravelWafeq
 */
enum AccountSubclassification: string
{
    case Bank = 'BANK';
    case AccountsReceivable = 'ACCOUNTS_RECEIVABLE';
    case OtherCurrentAsset = 'OTHER_CURRENT_ASSET';
    case FixedAsset = 'FIXED_ASSET';
    case OtherAsset = 'OTHER_ASSET';
    case AccountsPayable = 'ACCOUNTS_PAYABLE';
    case CreditCard = 'CREDIT_CARD';
    case OtherCurrentLiability = 'OTHER_CURRENT_LIABILITY';
    case LongTermLiability = 'LONG_TERM_LIABILITY';
    case Equity = 'EQUITY';
    case Income = 'INCOME';
    case OtherIncome = 'OTHER_INCOME';
    case CostOfGoodsSold = 'COST_OF_GOODS_SOLD';
    case Expense = 'EXPENSE';
    case OtherExpense = 'OTHER_EXPENSE';
    case NonPosting = 'NON_POSTING';
}
