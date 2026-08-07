<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $bankName
 * @property ?string $accountNumber
 * @property ?string $iban
 * @property ?string $currency
 * @property ?string $subclassification
 * @property bool $isPaymentEnabled
 * @property array<string, mixed> $extra
 */
/**
 * BankAccountData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class BankAccountData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $bankName = null,
        public ?string $accountNumber = null,
        public ?string $iban = null,
        public ?string $currency = null,
        public ?string $subclassification = null,
        public bool $isPaymentEnabled = false,
        public array $extra = [],
    ) {}
}
