<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property string $code
 * @property ?string $description
 * @property ?string $currency
 * @property ?string $subclassification
 * @property ?string $classification
 * @property bool $isSystem
 * @property bool $isPaymentEnabled
 * @property array<string, mixed> $extra
 */
/**
 * AccountData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class AccountData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $code = '',
        public ?string $description = null,
        public ?string $currency = null,
        public ?string $subclassification = null,
        public ?string $classification = null,
        public bool $isSystem = false,
        public bool $isPaymentEnabled = false,
        public array $extra = [],
    ) {}
}
