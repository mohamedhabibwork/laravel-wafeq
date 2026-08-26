<?php

use HWafeq\LaravelWafeq\Enums\AccountSubclassification;
use HWafeq\LaravelWafeq\Enums\BankAccountSubclassification;
use HWafeq\LaravelWafeq\Enums\BillStatus;
use HWafeq\LaravelWafeq\Enums\ChargeType;
use HWafeq\LaravelWafeq\Enums\Classification;
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\DiscountType;
use HWafeq\LaravelWafeq\Enums\ExpenseTaxAmountType;
use HWafeq\LaravelWafeq\Enums\Language41a;
use HWafeq\LaravelWafeq\Enums\LanguageAc1;
use HWafeq\LaravelWafeq\Enums\Medium;
use HWafeq\LaravelWafeq\Enums\PaymentRequestStatus;
use HWafeq\LaravelWafeq\Enums\PayslipStatus;
use HWafeq\LaravelWafeq\Enums\SimplifiedInvoiceStatus;
use HWafeq\LaravelWafeq\Enums\Status9b4;
use HWafeq\LaravelWafeq\Enums\TaxAmountType8ab;
use HWafeq\LaravelWafeq\Enums\TaxType;
use HWafeq\LaravelWafeq\Enums\Type;

/**
 * Helper — extract a list of `value` strings from an enum's cases().
 *
 * @param  class-string<BackedEnum>  $enum
 * @return array<int, string>
 */
function enum_values(string $enum): array
{
    return array_map(static fn ($c) => $c->value, $enum::cases());
}

/**
 * Each test below mirrors the matching `wafeq-docs/<name>enum.md` file
 * (source of truth: https://developer.wafeq.com/llms.txt). Update both
 * sides together whenever Wafeq publishes a new schema value.
 */
it('AccountSubclassification matches wafeq-docs', function () {
    expect(enum_values(AccountSubclassification::class))->toEqualCanonicalizing([
        'INCOME',
        'OTHER_INCOME',
        'COGS',
        'OPERATING_EXPENSE',
        'NON_OPERATING_EXPENSE',
        'CASH_EQUIVALENTS',
        'CURRENT_ASSET',
        'NON_CURRENT_ASSET',
        'FIXED_ASSET',
        'CURRENT_LIABILITY',
        'NON_CURRENT_LIABILITY',
        'PAID_IN_CAPITAL',
        'RETAINED_EARNINGS',
        'ACCUMULATED_OTHER_COMPREHENSIVE_INCOME',
        'TREASURY_STOCK',
        'OWNERS_EQUITY',
        'OPENING_BALANCE_EQUITY',
    ]);
});

it('BankAccountSubclassification matches wafeq-docs', function () {
    expect(enum_values(BankAccountSubclassification::class))->toEqualCanonicalizing([
        'BANK',
        'PETTY_CASH',
        'CREDIT_CARD',
    ]);
});

it('BillStatus matches wafeq-docs', function () {
    expect(enum_values(BillStatus::class))->toEqualCanonicalizing([
        'DRAFT',
        'AUTHORIZED',
        'PAID',
    ]);
});

it('ChargeType matches wafeq-docs', function () {
    expect(enum_values(ChargeType::class))->toEqualCanonicalizing([
        'OUR',
        'BEN',
        'SHA',
    ]);
});

it('Classification matches wafeq-docs', function () {
    expect(enum_values(Classification::class))->toEqualCanonicalizing([
        'REVENUE',
        'EXPENSE',
        'ASSET',
        'BANK',
        'LIABILITY',
        'EQUITY',
    ]);
});

it('Currency matches wafeq-docs', function () {
    expect(enum_values(Currency::class))->toEqualCanonicalizing([
        'AED', 'SAR', 'USD', 'EUR', 'CAD', 'AFN', 'ALL', 'AMD', 'ARS', 'AUD',
        'AZN', 'BAM', 'BDT', 'BGN', 'BHD', 'BIF', 'BND', 'BOB', 'BRL', 'BWP',
        'BYN', 'BZD', 'CDF', 'CHF', 'CLP', 'CNY', 'COP', 'CRC', 'CVE', 'CZK',
        'DJF', 'DKK', 'DOP', 'DZD', 'EGP', 'ERN', 'ETB', 'GBP', 'GEL', 'GHS',
        'GNF', 'GTQ', 'HKD', 'HNL', 'HRK', 'HUF', 'IDR', 'ILS', 'INR', 'IQD',
        'IRR', 'ISK', 'JMD', 'JOD', 'JPY', 'KES', 'KHR', 'KMF', 'KRW', 'KWD',
        'KZT', 'LBP', 'LKR', 'LYD', 'MAD', 'MDL', 'MGA', 'MKD', 'MMK', 'MOP',
        'MUR', 'MXN', 'MYR', 'MZN', 'NAD', 'NGN', 'NIO', 'NOK', 'NPR', 'NZD',
        'OMR', 'PAB', 'PEN', 'PHP', 'PKR', 'PLN', 'PYG', 'QAR', 'RON', 'RSD',
        'RUB', 'RWF', 'SDG', 'SEK', 'SGD', 'SOS', 'SYP', 'THB', 'TND', 'TOP',
        'TRY', 'TTD', 'TWD', 'TZS', 'UAH', 'UGX', 'UYU', 'UZS', 'VES', 'VND',
        'XAF', 'XOF', 'YER', 'ZAR', 'ZMW',
    ]);
});

it('DiscountType matches wafeq-docs', function () {
    expect(enum_values(DiscountType::class))->toEqualCanonicalizing([
        'percent',
        'amount',
    ]);
});

it('ExpenseTaxAmountType matches wafeq-docs', function () {
    expect(enum_values(ExpenseTaxAmountType::class))->toEqualCanonicalizing([
        'TAX_EXCLUSIVE',
        'TAX_INCLUSIVE',
    ]);
});

it('Language41a matches wafeq-docs', function () {
    expect(enum_values(Language41a::class))->toEqualCanonicalizing([
        'en',
        'ar',
    ]);
});

it('LanguageAc1 matches wafeq-docs', function () {
    expect(enum_values(LanguageAc1::class))->toEqualCanonicalizing([
        'ar',
        'en',
    ]);
});

it('Medium matches wafeq-docs', function () {
    expect(enum_values(Medium::class))->toEqualCanonicalizing([
        'email',
    ]);
});

it('PaymentRequestStatus matches wafeq-docs', function () {
    expect(enum_values(PaymentRequestStatus::class))->toEqualCanonicalizing([
        'DELETED', 'DRAFT', 'ERROR', 'FETCHING_STATUS', 'NOT_FOUND',
        'PENDING_APPROVAL', 'PENDING_RELEASE', 'PROCESSED', 'PROCESSING',
        'QUEUED', 'REJECTED', 'RELEASED', 'VALIDATED',
    ]);
});

it('PayslipStatus matches wafeq-docs', function () {
    expect(enum_values(PayslipStatus::class))->toEqualCanonicalizing([
        'DRAFT',
        'POSTED',
    ]);
});

it('SimplifiedInvoiceStatus matches wafeq-docs', function () {
    expect(enum_values(SimplifiedInvoiceStatus::class))->toEqualCanonicalizing([
        'DRAFT',
        'PAID',
    ]);
});

it('Status9b4 matches wafeq-docs', function () {
    expect(enum_values(Status9b4::class))->toEqualCanonicalizing([
        'DRAFT',
        'SENT',
    ]);
});

it('TaxAmountType8ab matches wafeq-docs', function () {
    expect(enum_values(TaxAmountType8ab::class))->toEqualCanonicalizing([
        'TAX_INCLUSIVE',
        'TAX_EXCLUSIVE',
    ]);
});

it('TaxType matches wafeq-docs', function () {
    expect(enum_values(TaxType::class))->toEqualCanonicalizing([
        'SALES',
        'PURCHASES',
        'REVERSE_CHARGE',
        'OUT_OF_SCOPE',
    ]);
});

it('Type matches wafeq-docs', function () {
    expect(enum_values(Type::class))->toEqualCanonicalizing([
        'percent',
        'amount',
    ]);
});
