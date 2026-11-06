<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaExemptionReason;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxCategory;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

/**
 * VAT applied to a line item, charge, discount or prepayment.
 *
 * ```php
 * ZatcaTaxData::standard();                                       // S 15%
 * ZatcaTaxData::zeroRated(ZatcaExemptionReason::ExportOfGoods);   // Z 0%
 * ZatcaTaxData::outOfScope('Not a taxable supply');               // O 0% VATEX-SA-OOS
 * ```
 */
class ZatcaTaxData extends ZatcaPayloadData
{
    /**
     * Saudi Arabia's standard VAT rate.
     */
    public const STANDARD_RATE = 15.0;

    public function __construct(
        #[WithCast(EnumCast::class)]
        public ZatcaTaxCategory $type,
        public float $percent,
        #[WithCast(EnumCast::class)]
        public ?ZatcaExemptionReason $exemptionReason = null,
        public ?string $exemptionReasonText = null,
    ) {}

    public static function standard(float $percent = self::STANDARD_RATE): self
    {
        return new self(ZatcaTaxCategory::Standard, $percent);
    }

    public static function zeroRated(ZatcaExemptionReason $reason, ?string $text = null): self
    {
        return new self(ZatcaTaxCategory::ZeroRated, 0.0, $reason, $text);
    }

    public static function exempt(ZatcaExemptionReason $reason, ?string $text = null): self
    {
        return new self(ZatcaTaxCategory::Exempt, 0.0, $reason, $text);
    }

    public static function outOfScope(string $text): self
    {
        return new self(ZatcaTaxCategory::OutOfScope, 0.0, ZatcaExemptionReason::OutOfScope, $text);
    }
}
