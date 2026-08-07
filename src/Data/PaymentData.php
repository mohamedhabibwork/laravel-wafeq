<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $reference
 * @property ?string $date
 * @property ?string $paymentType
 * @property ?string $amount
 * @property ?string $currency
 * @property ?string $contact
 * @property ?string $bankAccount
 * @property array<string, mixed> $extra
 */
/**
 * PaymentData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class PaymentData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $reference = null,
        public ?string $date = null,
        public ?string $paymentType = null,
        public ?string $amount = null,
        public ?string $currency = null,
        public ?string $contact = null,
        public ?string $bankAccount = null,
        public array $extra = [],
    ) {}
}
