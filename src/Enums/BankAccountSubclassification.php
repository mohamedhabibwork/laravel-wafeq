<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * BankAccountSubClassificationEnum mirrors the Wafeq
 * `BankAccountSubClassificationEnum` schema. Used for the `subclassification`
 * field on the BankAccount resource.
 *
 * @method static self Bank()
 * @method static self PettyCash()
 * @method static self CreditCard()
 *
 * @see LaravelWafeq
 */
enum BankAccountSubclassification: string
{
    case Bank = 'BANK';
    case PettyCash = 'PETTY_CASH';
    case CreditCard = 'CREDIT_CARD';
}
