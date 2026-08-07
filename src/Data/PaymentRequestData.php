<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $reference
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $date
 * @property ?string $payee
 * @property array<string, mixed> $extra
 */
/**
 * PaymentRequestData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class PaymentRequestData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $reference = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $currency = null,
        public ?string $date = null,
        public ?string $payee = null,
        public array $extra = [],
    ) {}
}
