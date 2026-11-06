<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaLanguage;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

/**
 * Optional top-level keys sent next to a document (report / validate /
 * issue) or on their own (send): delivery channels, PDF language,
 * metadata, your reference and the PDF template.
 */
class ZatcaDeliveryOptionsData extends ZatcaPayloadData
{
    /**
     * @param  array<int, ZatcaChannelData>  $channels
     * @param  array<string, string|null>|null  $metadata
     * @param  array<string, mixed>|null  $template
     */
    public function __construct(
        #[DataCollectionOf(ZatcaChannelData::class)]
        public array $channels = [],
        #[WithCast(EnumCast::class)]
        public ?ZatcaLanguage $language = null,
        public ?array $metadata = null,
        public ?string $reference = null,
        public ?array $template = null,
    ) {}
}
