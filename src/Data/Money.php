<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $amount
 * @property string $currency
 */
/**
 * Money Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class Money extends Data
{
    public function __construct(
        public string $amount = '',
        public string $currency = '',
    ) {}

    public function toFloat(): float
    {
        return (float) $this->amount;
    }

    public function formatted(): string
    {
        return sprintf('%s %s', $this->currency, $this->amount);
    }
}
