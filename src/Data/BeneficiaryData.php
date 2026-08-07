<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $bankName
 * @property ?string $accountNumber
 * @property ?string $iban
 * @property ?string $swift
 * @property ?string $currency
 * @property array<string, mixed> $extra
 */
/**
 * BeneficiaryData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class BeneficiaryData extends Data
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
        public ?string $swift = null,
        public ?string $currency = null,
        public array $extra = [],
    ) {}
}
